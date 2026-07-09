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
}