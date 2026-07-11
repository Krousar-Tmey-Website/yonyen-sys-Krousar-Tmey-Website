<?php

namespace Database\Seeders;

use App\Models\AnnualReport;
use App\Models\HistoryEvent;
use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeAndReportSeeder extends Seeder
{
    public function run(): void
    {
        // Offices
        $offices = [
            [
                'country'      => 'Cambodia',
                'city'         => 'Phnom Penh',
                'flag'         => '🇰🇭',
                'badge'        => 'Headquarters',
                'address'      => '#58, Street 478, Phnom Penh, Cambodia',
                'phone'        => '+855 (0)23 211 955',
                'email'        => 'info@krousar-thmey.org',
                'accent_color' => 'border-[#2d6fa3]',
                'badge_color'  => 'bg-[#2d6fa3] text-white',
                'sort_order'   => 1,
            ],
            [
                'country'      => 'France',
                'city'         => 'Paris',
                'flag'         => '🇫🇷',
                'badge'        => 'Europe',
                'address'      => '75, rue de la Roquette, 75011 Paris, France',
                'phone'        => '+33 (0)1 43 14 84 84',
                'email'        => 'france@krousar-thmey.org',
                'accent_color' => 'border-[#8da83a]',
                'badge_color'  => 'bg-[#8da83a] text-white',
                'sort_order'   => 2,
            ],
            [
                'country'      => 'Switzerland',
                'city'         => 'Geneva',
                'flag'         => '🇨🇭',
                'badge'        => 'Europe',
                'address'      => 'Case Postale 3018, 1211 Geneva 3, Switzerland',
                'phone'        => '+41 (0)79 456 78 90',
                'email'        => 'suisse@krousar-thmey.org',
                'accent_color' => 'border-[#8da83a]',
                'badge_color'  => 'bg-[#8da83a] text-white',
                'sort_order'   => 3,
            ],
            [
                'country'      => 'Singapore',
                'city'         => 'Singapore',
                'flag'         => '🇸🇬',
                'badge'        => 'Asia',
                'address'      => '10 Anson Road, #27-15, Singapore 079903',
                'phone'        => '+65 6123 4567',
                'email'        => 'singapore@krousar-thmey.org',
                'accent_color' => 'border-[#e8a020]',
                'badge_color'  => 'bg-[#e8a020] text-white',
                'sort_order'   => 4,
            ],
        ];

        foreach ($offices as $office) {
            Office::firstOrCreate(['country' => $office['country'], 'city' => $office['city']], $office);
        }

        // Annual Reports
        foreach ([2024, 2023, 2022, 2021, 2020, 2019] as $year) {
            AnnualReport::firstOrCreate(['year' => $year], [
                'title' => "Annual Report {$year}",
                'year'  => $year,
            ]);
        }

        // History Events
        $events = [
            ['year'=>'1991','sort_order'=>1,  'left_text'=>"Birth of Krousar Thmey with the opening of the orphanage of Dangrek, followed by the orphanage of O'Bok in Site II.", 'right_text'=>null],
            ['year'=>'1993','sort_order'=>2,  'left_text'=>'Repatriation of 154 children to Cambodia: a first permanent protection centre opens in Siem Reap.', 'right_text'=>null],
            ['year'=>'1994','sort_order'=>3,  'left_text'=>'The first temporary street children centre opens in Phnom Penh.', 'right_text'=>'The first school for blind children opens in Phnom Penh.'],
            ['year'=>'1998','sort_order'=>4,  'left_text'=>'Seamanship training starts for street children using trawlers in Sihanoukville.', 'right_text'=>'Opening of the school of arts in Serey Sophon and rebirth of shadow theatre which had disappeared under the Khmer Rouge Regime.'],
            ['year'=>'2000','sort_order'=>5,  'left_text'=>'Construction and opening of the first family house in TukThlaa, in the suburb of Phnom Penh.', 'right_text'=>null],
            ['year'=>'2001','sort_order'=>6,  'left_text'=>'Construction of the first school for deaf children in Chbar Ampov, in the suburb of Phnom Penh.', 'right_text'=>'The first campaign for the prevention of child trafficking and prostitution is launched.'],
            ['year'=>'2003','sort_order'=>7,  'left_text'=>'First enrollment of blind student in public school.', 'right_text'=>'First hearing aids for hearing-impaired children thanks to ENT doctors and hearing aid specialists of the organisation Enfants Sourds du Cambodge based in Toulon, France.'],
            ['year'=>'2005','sort_order'=>8,  'left_text'=>'First translation of national television news in Sign Language.', 'right_text'=>'Beginning of the awareness-raising campaigns on education for children with disabilities.'],
            ['year'=>'2008','sort_order'=>9,  'left_text'=>'First deaf students awarded the baccalaureate.', 'right_text'=>'A career and academic counselling department is created to facilitate access to higher education, professional training and employment.'],
            ['year'=>'2011','sort_order'=>10, 'left_text'=>'First blind students graduated from university.', 'right_text'=>'All the teaching staff is registered as civil servant by the Ministry of Education.'],
            ['year'=>'2013','sort_order'=>11, 'left_text'=>'First deaf students go to university.', 'right_text'=>'The Ministry of Education, Youth and Sports takes the financial responsibility of the Braille workshop and sign language committee.'],
            ['year'=>'2016','sort_order'=>12, 'left_text'=>'Signature of the agreement related to the transfer of the 5 special schools to the Cambodian Ministry of Education, Youth and Sport in the presence of His Majesty King Norodom Sihamoni on the occasion of the 25th anniversary of Krousar Thmey.', 'right_text'=>'Creation of the first Resource center for deaf or blind students in Battambang.'],
            ['year'=>'2019','sort_order'=>13, 'left_text'=>'Official ceremony of the transfer of the 5 special schools to the ministry of Education, Youth and Sports (MoEYS).', 'right_text'=>null],
        ];

        foreach ($events as $event) {
            HistoryEvent::firstOrCreate(
                ['year' => $event['year'], 'left_text' => $event['left_text']],
                array_merge($event, ['is_active' => true])
            );
        }
    }
}
