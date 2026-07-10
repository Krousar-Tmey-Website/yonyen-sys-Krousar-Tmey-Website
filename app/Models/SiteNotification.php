<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteNotification extends Model
{
    protected $table = 'site_notifications';

    protected $fillable = [
        'type',
        'title',
        'excerpt',
        'link',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('created_at');
    }

    /**
     * Visual + label metadata per notification type.
     */
    public static function typeMeta(): array
    {
        return [
            'event' => [
                'label' => 'New Event Added',
                'icon'  => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                'iconBg'   => 'bg-[#2d6fa3]/10',
                'iconText' => 'text-[#2d6fa3]',
                'badge'    => 'bg-[#2d6fa3]/10 text-[#2d6fa3]',
            ],
            'volunteer' => [
                'label' => 'Volunteer Recruitment',
                'icon'  => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87a4 4 0 01-3-3.87M15 4a4 4 0 11-8 0 4 4 0 018 0zM21 8a4 4 0 11-8 0 4 4 0 018 0z',
                'iconBg'   => 'bg-[#8da83a]/10',
                'iconText' => 'text-[#8da83a]',
                'badge'    => 'bg-[#8da83a]/10 text-[#8da83a]',
            ],
            'article' => [
                'label' => 'New Article Published',
                'icon'  => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                'iconBg'   => 'bg-amber-50',
                'iconText' => 'text-amber-500',
                'badge'    => 'bg-amber-50 text-amber-600',
            ],
            'general' => [
                'label' => 'Update',
                'icon'  => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'iconBg'   => 'bg-gray-100',
                'iconText' => 'text-gray-500',
                'badge'    => 'bg-gray-100 text-gray-600',
            ],
        ];
    }

    public function meta(): array
    {
        return static::typeMeta()[$this->type] ?? static::typeMeta()['general'];
    }
}
