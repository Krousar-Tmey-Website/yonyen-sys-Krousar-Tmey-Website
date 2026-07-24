<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LocalizationManager;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function __construct(protected LocalizationManager $localization) {}

    public function index()
    {
        $locales = $this->localization->locales();
        $meta = $this->localization->meta();
        $rows = $this->localization->rows();

        return view('admin.localization.index', [
            'locales' => $locales,
            'meta' => $meta,
            'rows' => $rows,
            'defaultLocale' => $this->localization->defaultLocale(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'rows' => ['array'],
            'rows.*.key' => ['required', 'string', 'max:500'],
            'rows.*.values' => ['array'],
            'rows.*.values.*' => ['nullable', 'string'],
        ]);

        try {
            $this->localization->saveRows($data['rows'] ?? []);
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.localization.index')
                ->with('error', 'Could not save: one of the values contains characters that could not be saved. Please check for unusual characters and try again.');
        }

        return redirect()->route('admin.localization.index')
            ->with('success', 'Translations saved successfully.');
    }

    public function storeKey(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:500'],
            'values' => ['nullable', 'array'],
            'values.*' => ['nullable', 'string'],
        ]);

        if (in_array($data['key'], $this->localization->allKeys(), true)) {
            return redirect()->route('admin.localization.index')
                ->with('error', 'That translation key already exists.');
        }

        try {
            $this->localization->addKey($data['key'], $data['values'] ?? []);
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.localization.index')
                ->with('error', 'Could not add this key: one of the values contains characters that could not be saved.');
        }

        return redirect()->route('admin.localization.index')
            ->with('success', 'Translation key added successfully.');
    }

    public function destroyKey(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:500'],
        ]);

        $this->localization->deleteKey($data['key']);

        return redirect()->route('admin.localization.index')
            ->with('success', 'Translation key deleted.');
    }

    public function storeLocale(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:10', 'regex:/^[A-Za-z_-]+$/', 'not_in:'.implode(',', $this->localization->locales())],
            'name' => ['required', 'string', 'max:100'],
            'native' => ['nullable', 'string', 'max:100'],
            'flag' => ['nullable', 'string', 'max:10'],
        ]);

        try {
            $this->localization->addLocale(
                $data['code'],
                $data['name'],
                $data['native'] ?? null,
                $data['flag'] ?? null
            );
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.localization.index')
                ->with('error', 'Could not add this language: one of the values contains characters that could not be saved.');
        }

        return redirect()->route('admin.localization.index')
            ->with('success', 'Language added successfully.');
    }

    public function destroyLocale(string $locale)
    {
        if ($locale === $this->localization->defaultLocale()) {
            return redirect()->route('admin.localization.index')
                ->with('error', 'The default language cannot be removed.');
        }

        $this->localization->deleteLocale($locale);

        return redirect()->route('admin.localization.index')
            ->with('success', 'Language removed.');
    }
}
