<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'email',
        'subscribed_at',
    ];

    protected function casts(): array
    {
        return [
            'subscribed_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (NewsletterSubscriber $subscriber) {
            if (empty($subscriber->subscribed_at)) {
                $subscriber->subscribed_at = now();
            }
        });
    }
}
