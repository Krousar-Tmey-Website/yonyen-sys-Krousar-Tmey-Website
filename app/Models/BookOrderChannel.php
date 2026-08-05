<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBookOrderChannel
 */
class BookOrderChannel extends Model
{
    protected $fillable = [
        'type',
        'icon_key',
        'label',
        'label_fr',
        'value',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Channel types offered in the admin picker, each with its default icon
     * and a hint shown next to the value field.
     */
    public const TYPES = [
        'email' => [
            'label' => 'Email',
            'icon' => 'mail',
            'placeholder' => 'orders@krousar-thmey.org',
            'hint' => 'An email address — clicking opens the visitor\'s mail client (or Gmail compose for @gmail.com addresses).',
        ],
        'phone' => [
            'label' => 'Phone / Call',
            'icon' => 'phone',
            'placeholder' => '+855 23 880 502',
            'hint' => 'A phone number — clicking dials it on mobile devices.',
        ],
        'telegram' => [
            'label' => 'Telegram',
            'icon' => 'telegram',
            'placeholder' => '@krousarthmey or https://t.me/krousarthmey',
            'hint' => 'A Telegram username (with or without @) or a full t.me link.',
        ],
        'whatsapp' => [
            'label' => 'WhatsApp',
            'icon' => 'whatsapp',
            'placeholder' => '+855 12 345 678',
            'hint' => 'A phone number (with country code) — clicking opens a WhatsApp chat.',
        ],
        'url' => [
            'label' => 'Website / Link (e.g. HelloAsso)',
            'icon' => 'link',
            'placeholder' => 'https://www.helloasso.com/associations/...',
            'hint' => 'A full web address the visitor is redirected to.',
        ],
    ];

    public const ICONS = [
        'mail' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
        'phone' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
        'telegram' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.874L5.999 12zm0 0h7.5"/>',
        'whatsapp' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
        'link' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getLocalizedLabelAttribute(): string
    {
        if (app()->getLocale() === 'fr' && !empty($this->label_fr)) {
            return $this->label_fr;
        }

        return $this->label;
    }

    public function getIconPathAttribute(): string
    {
        return self::ICONS[$this->icon_key] ?? self::ICONS['link'];
    }

    public function getHrefAttribute(): string
    {
        $value = trim($this->value);

        return match ($this->type) {
            'email' => 'mailto:' . $value,
            'phone' => 'tel:' . preg_replace('/[^0-9+]/', '', $value),
            'whatsapp' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $value),
            'telegram' => str_starts_with($value, 'http')
                ? $value
                : 'https://t.me/' . ltrim($value, '@'),
            default => str_starts_with($value, 'http') ? $value : 'https://' . $value,
        };
    }
}
