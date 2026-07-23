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
