<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

/**
 * Manages Laravel's native JSON translation files (lang/*.json) plus a small
 * sidecar metadata file (lang/.locales.json) that stores display info
 * (name / native name / flag) for each locale so the admin UI has something
 * nicer to show than a bare locale code. No database tables involved —
 * everything lives in the lang/ directory Laravel already reads from.
 */
class LocalizationManager
{
    protected string $langPath;

    protected string $metaPath;

    /**
     * Locales that ship with the app and always get sensible defaults even
     * before an admin ever touches the metadata file.
     */
    protected array $defaultMeta = [
        'en' => ['name' => 'English', 'native' => 'English', 'flag' => '🇬🇧'],
        'fr' => ['name' => 'French', 'native' => 'Français', 'flag' => '🇫🇷'],
    ];

    public function __construct()
    {
        $this->langPath = lang_path();
        $this->metaPath = lang_path('.locales.json');
    }

    public function defaultLocale(): string
    {
        return config('app.locale', 'en');
    }

    /**
     * All locale codes we know about, from json files on disk plus any
     * locale that only exists in the metadata file (e.g. just added).
     *
     * @return array<int, string>
     */
    public function locales(): array
    {
        $fromFiles = collect(File::glob($this->langPath.'/*.json'))
            ->map(fn ($path) => pathinfo($path, PATHINFO_FILENAME))
            ->reject(fn ($name) => str_starts_with($name, '.'))
            ->values();

        $fromMeta = collect(array_keys($this->meta()));

        $locales = $fromFiles->merge($fromMeta)->unique()->values()->all();

        // Default locale always first, rest alphabetical.
        usort($locales, function ($a, $b) {
            if ($a === $this->defaultLocale()) return -1;
            if ($b === $this->defaultLocale()) return 1;
            return strcmp($a, $b);
        });

        return $locales;
    }

    /**
     * Metadata (name/native/flag) for every known locale, keyed by code.
     */
    public function meta(): array
    {
        $stored = [];

        if (File::exists($this->metaPath)) {
            $decoded = json_decode(File::get($this->metaPath), true);
            if (is_array($decoded)) {
                $stored = $decoded;
            }
        }

        return array_replace($this->defaultMeta, $stored);
    }

    public function metaFor(string $locale): array
    {
        $meta = $this->meta();

        return $meta[$locale] ?? [
            'name' => strtoupper($locale),
            'native' => strtoupper($locale),
            'flag' => '🌐',
        ];
    }

    /**
     * Locale => translated string map for a single locale file.
     */
    public function translations(string $locale): array
    {
        $path = $this->langPath.'/'.$locale.'.json';

        if (! File::exists($path)) {
            return [];
        }

        $decoded = json_decode(File::get($path), true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Every translation key used anywhere across all locale files, sorted.
     *
     * @return array<int, string>
     */
    public function allKeys(): array
    {
        $keys = [];

        foreach ($this->locales() as $locale) {
            $keys = array_merge($keys, array_keys($this->translations($locale)));
        }

        $keys = array_values(array_unique($keys));
        sort($keys, SORT_NATURAL | SORT_FLAG_CASE);

        return $keys;
    }

    /**
     * Rows shaped for the admin table: [['key' => ..., 'values' => [locale => value]], ...]
     */
    public function rows(): array
    {
        $locales = $this->locales();
        $translationsByLocale = [];
        foreach ($locales as $locale) {
            $translationsByLocale[$locale] = $this->translations($locale);
        }

        $rows = [];
        foreach ($this->allKeys() as $key) {
            $values = [];
            foreach ($locales as $locale) {
                $values[$locale] = $translationsByLocale[$locale][$key] ?? '';
            }

            $rows[] = ['key' => $key, 'values' => $values];
        }

        return $rows;
    }

    /**
     * Merge a set of key => translations per locale onto whatever already
     * exists in each lang/{locale}.json file (rows are additive/overwriting,
     * never a wholesale replace — this stays correct even if the form only
     * submitted a filtered subset of keys). A blank value for a locale
     * removes any override for that key, so Laravel's built-in fallback
     * (to app.fallback_locale) kicks in automatically.
     *
     * @param  array<int, array{key: string, values: array<string, string>}>  $rows
     */
    public function saveRows(array $rows): void
    {
        $locales = $this->locales();
        $maps = [];
        foreach ($locales as $locale) {
            $maps[$locale] = $this->translations($locale);
        }

        foreach ($rows as $row) {
            $key = $this->sanitizeUtf8(trim((string) ($row['key'] ?? '')));
            if ($key === '') {
                continue;
            }

            foreach ($locales as $locale) {
                $value = $this->sanitizeUtf8(trim((string) ($row['values'][$locale] ?? '')));
                if ($value !== '') {
                    $maps[$locale][$key] = $value;
                } else {
                    unset($maps[$locale][$key]);
                }
            }
        }

        foreach ($maps as $locale => $map) {
            $this->writeLocaleFile($locale, $map);
        }
    }

    public function addKey(string $key, array $initialValues = []): void
    {
        $key = $this->sanitizeUtf8(trim($key));
        if ($key === '') {
            return;
        }

        foreach ($this->locales() as $locale) {
            $map = $this->translations($locale);
            if (! array_key_exists($key, $map)) {
                $value = $this->sanitizeUtf8(trim((string) ($initialValues[$locale] ?? '')));
                if ($value !== '') {
                    $map[$key] = $value;
                }
            }
            $this->writeLocaleFile($locale, $map);
        }
    }

    public function deleteKey(string $key): void
    {
        foreach ($this->locales() as $locale) {
            $map = $this->translations($locale);
            unset($map[$key]);
            $this->writeLocaleFile($locale, $map);
        }
    }

    public function addLocale(string $code, string $name, ?string $native = null, ?string $flag = null): void
    {
        $code = strtolower(trim($code));
        $name = $this->sanitizeUtf8(trim($name));
        $native = $native !== null ? $this->sanitizeUtf8(trim($native)) : null;
        $flag = $flag !== null ? $this->sanitizeUtf8(trim($flag)) : null;

        if (! File::exists($this->langPath.'/'.$code.'.json')) {
            $this->writeLocaleFile($code, []);
        }

        $meta = $this->meta();
        $meta[$code] = [
            'name' => $name,
            'native' => $native ?: $name,
            'flag' => $flag ?: '🌐',
        ];

        $this->writeMeta($meta);
    }

    public function deleteLocale(string $code): void
    {
        if ($code === $this->defaultLocale()) {
            return;
        }

        $path = $this->langPath.'/'.$code.'.json';
        if (File::exists($path)) {
            File::delete($path);
        }

        $meta = $this->meta();
        unset($meta[$code]);
        $this->writeMeta($meta);
    }

    /**
     * Best-effort fix for invalid UTF-8 byte sequences (e.g. from a mis-encoded
     * paste). We never want a bad value to make json_encode() fail silently —
     * that would turn a single bad character into a wiped-out translation file.
     */
    protected function sanitizeUtf8(string $value): string
    {
        if ($value === '' || mb_check_encoding($value, 'UTF-8')) {
            return $value;
        }

        return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
    }

    protected function encodeOrFail(array $data, string $target): string
    {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($json === false) {
            throw new \RuntimeException(
                "Refusing to write {$target}: ".json_last_error_msg().'. No changes were saved.'
            );
        }

        return $json;
    }

    protected function writeLocaleFile(string $locale, array $map): void
    {
        ksort($map, SORT_NATURAL | SORT_FLAG_CASE);

        $json = $this->encodeOrFail($map, "lang/{$locale}.json");

        File::put($this->langPath.'/'.$locale.'.json', $json.PHP_EOL);
    }

    protected function writeMeta(array $meta): void
    {
        $json = $this->encodeOrFail($meta, 'lang/.locales.json');

        File::put($this->metaPath, $json.PHP_EOL);
    }
}
