<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model
{
    protected $guarded = [];

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedRoleAttribute(): ?string
    {
        return $this->localized('role');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        return $this->localized('content');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
