<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guarded = [];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function grants()
    {
        return $this->hasMany(ProjectGrant::class)->orderBy('sort_order');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/project.jpg'); // Fallback
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    public function getLocalizedObjectiveAttribute(): ?string
    {
        return $this->localized('objective');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        return $this->localized('content');
    }

    public function getLocalizedActivitiesAttribute(): ?string
    {
        return $this->localized('activities');
    }

    public function getLocalizedTestimonyNameAttribute(): ?string
    {
        return $this->localized('testimony_name');
    }

    public function getLocalizedTestimonyStoryAttribute(): ?string
    {
        return $this->localized('testimony_story');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }

    public function getEffectiveAreaOfWorkAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['area_of_work'] ?? null, 'project_default_area_of_work');
    }

    public function getEffectiveDurationAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['duration'] ?? null, 'project_default_duration');
    }

    public function getEffectiveLocationAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['location'] ?? null, 'project_default_location');
    }

    public function getEffectiveBeneficiariesAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['beneficiaries'] ?? null, 'project_default_beneficiaries');
    }

    public function getEffectiveMakeDifferenceTextAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['make_difference_text'] ?? null, 'project_default_make_difference_text');
    }

    public function getEffectiveMakeDifferenceTitleAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['make_difference_title'] ?? null, 'project_default_make_difference_title');
    }

    public function getEffectiveDonateButtonTextAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['donate_button_text'] ?? null, 'project_default_donate_button_text');
    }

    public function getEffectiveContactButtonTextAttribute(): string
    {
        return $this->resolveProjectDefault($this->attributes['contact_button_text'] ?? null, 'project_default_contact_button_text');
    }

    public function getUsesSpecificPageDetailsAttribute(): bool
    {
        return collect([
            $this->attributes['area_of_work'] ?? null,
            $this->attributes['duration'] ?? null,
            $this->attributes['location'] ?? null,
            $this->attributes['beneficiaries'] ?? null,
            $this->attributes['make_difference_text'] ?? null,
            $this->attributes['make_difference_title'] ?? null,
            $this->attributes['donate_button_text'] ?? null,
            $this->attributes['contact_button_text'] ?? null,
        ])->contains(fn ($value) => trim((string) $value) !== '');
    }

    protected function resolveProjectDefault(?string $value, string $settingKey): string
    {
        $trimmed = trim((string) $value);

        if ($trimmed !== '') {
            return $trimmed;
        }

        return HomeSetting::getValue($settingKey, '');
    }
}
