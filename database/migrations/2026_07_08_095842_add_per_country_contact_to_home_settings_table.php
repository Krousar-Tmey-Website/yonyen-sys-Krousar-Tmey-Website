<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $countries = [
            [
                'id'      => 'cambodia',
                'flag'    => '🇰🇭',
                'name'    => 'Cambodia',
                'address' => "Krousar Thmey Cambodia\n#145 street 132, Toeuk Laâk I, Toul Kork\nPhnom Penh - PO Box 1393",
                'phone'   => '+855 (0)23 880 502',
                'email'   => 'communication@krousar-thmey.org',
            ],
            [
                'id'      => 'france',
                'flag'    => '🇫🇷',
                'name'    => 'France',
                'address' => "Krousar Thmey France\n62 rue Greneta\n75002 Paris",
                'phone'   => '01 40 13 06 30',
                'email'   => 'france@krousar-thmey.org',
            ],
            [
                'id'      => 'singapore',
                'flag'    => '🇸🇬',
                'name'    => 'Singapore',
                'address' => "Krousar Thmey Singapore\n29 Leonie Hill, Horizon Towers West\nApt 13-04\nSingapore",
                'phone'   => '+65 98 506 438',
                'email'   => 'singapore@krousar-thmey.org',
            ],
            [
                'id'      => 'switzerland',
                'flag'    => '🇨🇭',
                'name'    => 'Switzerland',
                'address' => "Krousar Thmey Switzerland\nc/o Mme Sylvie Bédat\nRoute de Florissant 89 A\n1206 Geneva",
                'phone'   => '+41 79 203 70 82',
                'email'   => 'switzerland@krousar-thmey.org',
            ],
        ];

        foreach ($countries as $country) {
            HomeSetting::updateOrCreate(
                ['key' => "contact_{$country['id']}_address"],
                ['label' => "{$country['flag']} {$country['name']} — Address", 'group' => 'contact', 'value' => $country['address']]
            );
            HomeSetting::updateOrCreate(
                ['key' => "contact_{$country['id']}_phone"],
                ['label' => "{$country['flag']} {$country['name']} — Phone", 'group' => 'contact', 'value' => $country['phone']]
            );
            HomeSetting::updateOrCreate(
                ['key' => "contact_{$country['id']}_email"],
                ['label' => "{$country['flag']} {$country['name']} — Email", 'group' => 'contact', 'value' => $country['email']]
            );
        }
    }

    public function down(): void
    {
        $keys = [
            'contact_cambodia_address', 'contact_cambodia_phone', 'contact_cambodia_email',
            'contact_france_address', 'contact_france_phone', 'contact_france_email',
            'contact_singapore_address', 'contact_singapore_phone', 'contact_singapore_email',
            'contact_switzerland_address', 'contact_switzerland_phone', 'contact_switzerland_email',
        ];
        HomeSetting::whereIn('key', $keys)->delete();
    }
};
