<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapProject extends Model
{
    protected $fillable = [
        'province_key',
        'province_label',
        'location_name',
        'location_name_fr',
        'project_type',
        'sort_order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedLocationNameAttribute(): ?string
    {
        return $this->localized('location_name');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }

    /**
     * Get all map projects grouped and structured for the frontend.
     */
    public static function getFrontendData(): array
    {
        $records = static::ordered()->get();
        $grouped = [];

        foreach ($records as $record) {
            $key = $record->province_key;

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'label' => $record->province_label,
                    'locations' => [],
                ];
            }

            // Find or create location
            $locIdx = null;
            foreach ($grouped[$key]['locations'] as $i => $loc) {
                if ($loc['name'] === $record->location_name) {
                    $locIdx = $i;
                    break;
                }
            }

            if ($locIdx === null) {
                $locIdx = count($grouped[$key]['locations']);
                $grouped[$key]['locations'][] = [
                    'name' => $record->localized_location_name,
                    'projects' => [],
                ];
            }

            $grouped[$key]['locations'][$locIdx]['projects'][] = $record->project_type;
        }

        return $grouped;
    }
}
