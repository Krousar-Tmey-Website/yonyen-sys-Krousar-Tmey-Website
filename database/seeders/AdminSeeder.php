<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\HomeSetting;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@krousar-thmey.org'],
            [
                'name'     => 'Krousar Thmey Admin',
                'password' => Hash::make('Admin@KT2024'),
                'is_admin' => true,
            ]
        );

        // ── Home settings ─────────────────────────────────────
        $homeSettings = [
            // Stats group
            ['key' => 'stat_children',   'label' => 'Children Supported',        'group' => 'stats', 'value' => '4,079'],
            ['key' => 'stat_employees',  'label' => 'Employees',                  'group' => 'stats', 'value' => '70'],
            ['key' => 'stat_budget',     'label' => 'USD Annual Budget',          'group' => 'stats', 'value' => '950000'],
            ['key' => 'stat_provinces',  'label' => 'Provinces',                  'group' => 'stats', 'value' => '15'],
            // Hero group
            ['key' => 'hero_banner_text',           'label' => 'Hero Banner Text',           'group' => 'hero', 'value' => 'Krousar Thmey is Cambodia’s first organization helping disadvantaged children through child welfare, special education, and cultural development.'],
            ['key' => 'hero_button_primary_text',   'label' => 'Hero Primary Button Text',   'group' => 'hero', 'value' => 'Donate Now'],
            ['key' => 'hero_button_primary_url',    'label' => 'Hero Primary Button URL',    'group' => 'hero', 'value' => '/donate'],
            ['key' => 'hero_button_secondary_text', 'label' => 'Hero Secondary Button Text', 'group' => 'hero', 'value' => 'Learn More'],
            ['key' => 'hero_button_secondary_url',  'label' => 'Hero Secondary Button URL', 'group' => 'hero', 'value' => '/our-programs'],
            // About section
            ['key' => 'about_section_label', 'label' => 'About Section Label', 'group' => 'about', 'value' => 'Our Mission'],
            ['key' => 'about_title',         'label' => 'About Section Title', 'group' => 'about', 'value' => 'The First Cambodian Organization for Disadvantaged Children'],
            ['key' => 'about_text',          'label' => 'About Section Text', 'group' => 'about', 'value' => 'Born in 1991 in the Site II refugee camp in Thailand, Krousar Thmey — meaning "New Family" in Khmer — was established with a single vision: that every disadvantaged child in Cambodia deserves safety, education, and a sense of cultural identity.'],
            ['key' => 'about_subtext',       'label' => 'About Section Subtext', 'group' => 'about', 'value' => 'We believe in development led by Cambodians, for Cambodians. With three core programs spanning child welfare, special education, and cultural arts, we reach children across all 15 provinces of Cambodia.'],
            ['key' => 'about_image',         'label' => 'About Section Image', 'group' => 'about', 'value' => 'https://images.unsplash.com/photo-1527689368864-3a821dbccc34?w=700&q=80'],
            // Programs section
            ['key' => 'programs_title',    'label' => 'Programs Section Title',    'group' => 'programs', 'value' => 'What We Do'],
            ['key' => 'programs_subtitle', 'label' => 'Programs Section Subtitle', 'group' => 'programs', 'value' => 'Operating across 15 Cambodian provinces, our programs address the most pressing needs of vulnerable children.'],
            ['key' => 'programs_featured', 'label' => 'Featured Programs (comma separated slugs)', 'group' => 'programs', 'value' => 'child-welfare,special-education'],
            // News section
            ['key' => 'news_title',    'label' => 'News Section Title',    'group' => 'news', 'value' => 'Latest Updates'],
            ['key' => 'news_subtitle', 'label' => 'News Section Subtitle', 'group' => 'news', 'value' => 'News and stories about our impact, events, and community progress.'],
            // Partners section
            ['key' => 'partners_title',    'label' => 'Partners Section Title',    'group' => 'partners', 'value' => 'Supported by our partners worldwide'],
            ['key' => 'partners_subtitle', 'label' => 'Partners Section Subtitle', 'group' => 'partners', 'value' => 'Together we reach communities across Cambodia.'],
            ['key' => 'partners_logos',    'label' => 'Partner Logos List',       'group' => 'partners', 'value' => 'UNICEF, USAID, AFD, Handicap International, European Union, Aide et Action'],
            // Call to action
            ['key' => 'cta_label',           'label' => 'CTA Label',           'group' => 'cta', 'value' => 'Support Our Work'],
            ['key' => 'cta_title',           'label' => 'CTA Title',           'group' => 'cta', 'value' => 'Help a Child Build Their Future'],
            ['key' => 'cta_subtitle',        'label' => 'CTA Subtitle',        'group' => 'cta', 'value' => 'We guarantee that 100% of your donation is used to support children across Cambodia. Every contribution, big or small, changes a life.' ],
            ['key' => 'cta_primary_text',    'label' => 'CTA Primary Button Text',   'group' => 'cta', 'value' => 'Donate Now'],
            ['key' => 'cta_primary_url',     'label' => 'CTA Primary Button URL',   'group' => 'cta', 'value' => '/donate'],
            ['key' => 'cta_secondary_text',  'label' => 'CTA Secondary Button Text', 'group' => 'cta', 'value' => 'Get Involved'],
            ['key' => 'cta_secondary_url',   'label' => 'CTA Secondary Button URL', 'group' => 'cta', 'value' => '/get-involved'],
            // Structure map
            ['key' => 'structure_heading',       'label' => 'Structure Map — Heading',            'group' => 'structure', 'value' => "KROUSAR THMEY'S STRUCTURES"],
            ['key' => 'structure_welfare_title', 'label' => 'Structure Map — Child Welfare Title', 'group' => 'structure', 'value' => 'Child Welfare Program'],
            ['key' => 'structure_welfare_items', 'label' => 'Structure Map — Child Welfare Items', 'group' => 'structure', 'value' => "2 Temporary Protection Centers\n2 Long-term Protection Centers\n2 Family Houses\nOutside Cases"],
            ['key' => 'structure_education_title','label' => 'Structure Map — Education Title',    'group' => 'structure', 'value' => 'Education for Deaf or Blind Children Program'],
            ['key' => 'structure_education_items','label' => 'Structure Map — Education Items',    'group' => 'structure', 'value' => "5 Special Education High Schools"],
            ['key' => 'structure_image',         'label' => 'Structure Map — Image URL',           'group' => 'structure', 'value' => asset('images/cambodia-map.png')],
            // Programs section
            ['key' => 'programs_badge',  'label' => 'Programs — Badge Text', 'group' => 'programs', 'value' => 'WHAT WE DO'],
            ['key' => 'programs_heading','label' => 'Programs — Heading',     'group' => 'programs', 'value' => 'Two Programs, One Mission'],
            ['key' => 'programs_cta',    'label' => 'Programs — CTA Button',  'group' => 'programs', 'value' => 'View All Programs'],
            ['key' => 'programs_learn_btn', 'label' => 'Programs — Card Learn More Button', 'group' => 'programs', 'value' => 'Learn More'],
            // Partners section
            ['key' => 'partners_heading', 'label' => 'Partners — Section Heading', 'group' => 'partners', 'value' => 'Supported by Our Partners Worldwide'],
            // Footer contact
            ['key' => 'footer_address', 'label' => 'Footer Address', 'group' => 'footer', 'value' => '#58, Street 478, Phnom Penh, Cambodia'],
            ['key' => 'footer_phone',   'label' => 'Footer Phone',   'group' => 'footer', 'value' => '+855 (0)23 211 955'],
            ['key' => 'footer_email',   'label' => 'Footer Email',   'group' => 'footer', 'value' => 'info@krousar-thmey.org'],
            // Hero slides (models still control the carousel)
            ['key' => 'hero_slide_1_title',    'label' => 'Slide 1 — Title',    'group' => 'hero', 'value' => 'Education Without Borders'],
            ['key' => 'hero_slide_1_subtitle', 'label' => 'Slide 1 — Subtitle', 'group' => 'hero', 'value' => 'Krousar Thmey supports 4,079 disadvantaged children across 15 Cambodian provinces'],
            ['key' => 'hero_slide_2_title',    'label' => 'Slide 2 — Title',    'group' => 'hero', 'value' => 'Culture & Identity'],
            ['key' => 'hero_slide_2_subtitle', 'label' => 'Slide 2 — Subtitle', 'group' => 'hero', 'value' => 'Preserving Cambodian heritage through arts, music, and shadow theatre since 1991'],
            ['key' => 'hero_slide_3_title',    'label' => 'Slide 3 — Title',    'group' => 'hero', 'value' => 'Special Education'],
            ['key' => 'hero_slide_3_subtitle', 'label' => 'Slide 3 — Subtitle', 'group' => 'hero', 'value' => 'Pioneering deaf and blind education, integrating students into public schools and universities'],
            // Mission group
            ['key' => 'mission_title', 'label' => 'Mission Title', 'group' => 'mission', 'value' => 'Our Mission'],
            ['key' => 'mission_text',  'label' => 'Mission Text',  'group' => 'mission', 'value' => 'Since 1991, Krousar Thmey has been dedicated to the development of disadvantaged children in Cambodia, ensuring they grow with identity, integration, and dignity.'],
            // Social Links group
            ['key' => 'social_facebook',  'label' => 'Facebook URL',  'group' => 'social', 'value' => 'https://www.facebook.com/share/1LC1ZVXgen/?mibextid=wwXIfr'],
            ['key' => 'social_youtube',   'label' => 'YouTube URL',   'group' => 'social', 'value' => 'https://www.youtube.com/@krousarthmeyvideos'],
            ['key' => 'social_instagram', 'label' => 'Instagram URL', 'group' => 'social', 'value' => 'https://www.instagram.com/krousar_thmey_foundation?igsh=MWJpZXQ4YXZraDAyNg=='],
            ['key' => 'social_telegram',  'label' => 'Telegram URL',  'group' => 'social', 'value' => 'https://t.me/krousarthmey'],
            ['key' => 'social_linkedin',  'label' => 'LinkedIn URL',  'group' => 'social', 'value' => 'https://www.linkedin.com/company/krousar-thmey/'],
        ];

        foreach ($homeSettings as $setting) {
            HomeSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // ── Programs ──────────────────────────────────────────
        $programs = [
            ['title' => 'Child Welfare',                       'slug' => 'child-welfare',     'image' => 'children.jpg',  'sort_order' => 1, 'description' => 'Providing safe family-based care for vulnerable and orphaned children.', 'stats' => [['label' => 'Children', 'value' => '240']]],
            ['title' => 'Education for Deaf or Blind Children', 'slug' => 'special-education', 'image' => 'special-ed.jpg','sort_order' => 2, 'description' => 'Specialised schooling and integration into mainstream education.', 'stats' => [['label' => 'Students', 'value' => '768']]],
            ['title' => 'Cultural and Artistic Development',    'slug' => 'cultural-arts',     'image' => 'cultural.jpg',  'sort_order' => 3, 'description' => 'Reconnecting children with Khmer traditions through arts and shadow theatre.', 'stats' => [['label' => 'Students', 'value' => '1,088']]],
            ['title' => 'Academic and Career Counseling',       'slug' => 'career-counseling', 'image' => 'program.jpg',   'sort_order' => 4, 'description' => 'Supporting access to higher education, training, and employment.', 'stats' => [['label' => 'Students', 'value' => '357']]],
            ['title' => 'Health and Hygiene',                   'slug' => 'health-hygiene',    'image' => 'hygiene.jpg',   'sort_order' => 5, 'description' => 'Promoting health education and sanitation practices.', 'stats' => []],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], array_merge($prog, ['is_active' => true]));
        }

        // ── Partners ──────────────────────────────────────────
        $partners = [
            // Cambodian Authorities
            ['name' => 'His Majesty the King NORODOM Sihamoni',                                       'category' => 'authorities', 'sort_order' => 1],
            ['name' => 'Her Majesty the Queen Mother NORODOM Monineath Sihanouk',                     'category' => 'authorities', 'sort_order' => 2],
            ['name' => 'Prime Minister Samdech Moha Borvor Thipadei HUN Manet',                       'category' => 'authorities', 'sort_order' => 3],
            ['name' => 'Samdech Akka Moha Sena Padei Techo Hun Sen, President of the Senate',        'category' => 'authorities', 'sort_order' => 4],
            ['name' => 'Samdech Dr. Bun Rany HUN Sen',                                                'category' => 'authorities', 'sort_order' => 5],
            ['name' => 'The Royal Government of Cambodia',                                             'category' => 'authorities', 'sort_order' => 6],
            ['name' => 'Ministry of Social Affairs',                                                   'category' => 'authorities', 'sort_order' => 7],
            ['name' => 'Ministry of Education, Youth and Sport',                                       'category' => 'authorities', 'sort_order' => 8],
            ['name' => 'Ministry of Culture and Fine Arts',                                            'category' => 'authorities', 'sort_order' => 9],
            ['name' => 'Ministry of Defense',                                                          'category' => 'authorities', 'sort_order' => 10],
            ['name' => 'Ministry of Information',                                                      'category' => 'authorities', 'sort_order' => 11],
            ['name' => 'Ministry of Interior',                                                         'category' => 'authorities', 'sort_order' => 12],
            ['name' => 'H.E. the ambassador for Cambodia at UNESCO',                                   'category' => 'authorities', 'sort_order' => 13],
            ['name' => 'H.E. the ambassador for Cambodia to France',                                   'category' => 'authorities', 'sort_order' => 14],
            // Organizations
            ['name' => 'DUBRULLE Family',                                      'category' => 'organizations', 'sort_order' => 1],
            ['name' => 'ENFANCE ESPOIR Foundation',                            'category' => 'organizations', 'sort_order' => 2],
            ['name' => 'Fondation Amanjaya',                                   'category' => 'organizations', 'sort_order' => 3],
            ['name' => 'Fondation André & Cyprien',                            'category' => 'organizations', 'sort_order' => 4],
            ['name' => 'Fondation Masalina',                                   'category' => 'organizations', 'sort_order' => 5],
            ['name' => 'Fonds Mécénat SIG',                                    'category' => 'organizations', 'sort_order' => 6],
            ['name' => 'Foundation Philanthropique Famille Sandoz',            'category' => 'organizations', 'sort_order' => 7],
            ['name' => 'Gertrude Hirzel Foundation',                           'category' => 'organizations', 'sort_order' => 8],
            ['name' => 'GREEN LEAVES EDUCATION Foundation',                    'category' => 'organizations', 'sort_order' => 9],
            ['name' => 'Individual donor: Peter Tschofen',                     'category' => 'organizations', 'sort_order' => 10],
            ['name' => 'Individual donor: Suzanne ROY, Grants Barbe',          'category' => 'organizations', 'sort_order' => 11],
            ['name' => 'ICEVI',                                                 'category' => 'organizations', 'sort_order' => 12],
            ['name' => 'LA VOIX DE L\'ENFANT Association',                     'category' => 'organizations', 'sort_order' => 13],
            ['name' => 'LES AMIS DES ENFANTS DU MONDE Association',            'category' => 'organizations', 'sort_order' => 14],
            ['name' => 'MAY-OUI Foundation',                                   'category' => 'organizations', 'sort_order' => 15],
            ['name' => 'Miwako Fujiwara – Musica Felice Foundation',           'category' => 'organizations', 'sort_order' => 16],
            ['name' => 'Musica Felice',                                         'category' => 'organizations', 'sort_order' => 17],
            ['name' => 'OVERBROOK SCHOOL FOR THE BLIND (ONNET)',               'category' => 'organizations', 'sort_order' => 18],
            ['name' => 'PAfID — People\'s Action for Inclusive Development',  'category' => 'organizations', 'sort_order' => 19],
            ['name' => 'Raksa Koma Organization',                              'category' => 'organizations', 'sort_order' => 20],
            ['name' => 'ROTARY CLUB OF PERTH',                                 'category' => 'organizations', 'sort_order' => 21],
            ['name' => 'ROTARY CLUB OF PHNOM PENH',                            'category' => 'organizations', 'sort_order' => 22],
            ['name' => 'STIFTUNG HIRTEN KINDER Foundation',                    'category' => 'organizations', 'sort_order' => 23],
            ['name' => 'TALIKA',                                                'category' => 'organizations', 'sort_order' => 24],
            ['name' => 'UNICEF',                                                'category' => 'organizations', 'sort_order' => 25],
            // Companies
            ['name' => 'ABA BANK',                              'category' => 'companies', 'sort_order' => 1],
            ['name' => 'AMANJAYA HOTEL',                        'category' => 'companies', 'sort_order' => 2],
            ['name' => 'ANGKOR ARTWORK (Eric STOCKER)',          'category' => 'companies', 'sort_order' => 3],
            ['name' => 'BAJAJ INTRACITY',                       'category' => 'companies', 'sort_order' => 4],
            ['name' => 'BRED BANK CAMBODIA',                    'category' => 'companies', 'sort_order' => 5],
            ['name' => 'BLIND MASSAGE CENTER',                  'category' => 'companies', 'sort_order' => 6],
            ['name' => 'BODIA NATURE',                          'category' => 'companies', 'sort_order' => 7],
            ['name' => 'CAMH Co. LTD',                          'category' => 'companies', 'sort_order' => 8],
            ['name' => 'CMDK',                                  'category' => 'companies', 'sort_order' => 9],
            ['name' => 'D+Z URBAN HOTEL',                       'category' => 'companies', 'sort_order' => 10],
            ['name' => 'KHMER CERAMICS & FINE ARTS CENTER',     'category' => 'companies', 'sort_order' => 11],
            ['name' => 'LONG RA Car mechanic',                  'category' => 'companies', 'sort_order' => 12],
            ['name' => 'PROMOTION FOR DISABILITY PROJECT',      'category' => 'companies', 'sort_order' => 13],
            ['name' => 'PUNLEU THMEY Restaurant',               'category' => 'companies', 'sort_order' => 14],
            ['name' => 'RADIO HAPPINESS VOICE FOR THE BLIND',   'category' => 'companies', 'sort_order' => 15],
            ['name' => 'SAN FRANSISCO COMPANY',                 'category' => 'companies', 'sort_order' => 16],
            ['name' => 'SEIN LIM',                              'category' => 'companies', 'sort_order' => 17],
            ['name' => 'SENG POV Car mechanic',                 'category' => 'companies', 'sort_order' => 18],
            ['name' => 'SMART Cambodia',                        'category' => 'companies', 'sort_order' => 19],
            ['name' => 'SOCIAL COFFEE',                         'category' => 'companies', 'sort_order' => 20],
            ['name' => 'SOFITEL Phnom Penh Phokeethra',         'category' => 'companies', 'sort_order' => 21],
            ['name' => 'SOFT SKILL PROFESSIONAL TRAINING',      'category' => 'companies', 'sort_order' => 22],
            ['name' => 'TEMPLATION ANGKOR BOUTIQUE',            'category' => 'companies', 'sort_order' => 23],
            ['name' => 'THALIAS (Malis, Khema, Arunreas Hotel)','category' => 'companies', 'sort_order' => 24],
            ['name' => 'TOP STREET RESTAURANT',                 'category' => 'companies', 'sort_order' => 25],
            ['name' => 'VOICE OF THE BLIND Radio station',      'category' => 'companies', 'sort_order' => 26],
            // Towns
            ['name' => 'City of Geneva',                                              'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 1],
            ['name' => 'City of Meyrin',                                              'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 2],
            ['name' => 'Town of Hermance',                                            'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 3],
            ['name' => 'Towns of Collonge-Bellerive, Hermance and Vandoeuvres',      'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 4],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name'], 'category' => $partner['category']],
                array_merge($partner, ['is_active' => true])
            );
        }

        // ── Awards ────────────────────────────────────────────
        $awards = [
            ['title' => 'Hero Award',                                  'recipient' => 'Benoît Duchâteau-Arminjon', 'organization' => 'World of Children',          'description' => 'Awarded for the long-lasting impact of the actions conducted by former honorees.',                          'icon' => '⭐', 'sort_order' => 1],
            ['title' => 'Trophy for French Living Abroad',             'recipient' => 'Benoît Duchâteau-Arminjon', 'organization' => 'French Republic',            'description' => 'Humanitarian and social category.',                                                                         'icon' => '🏅', 'sort_order' => 2],
            ['title' => 'Top 10 Best Teachers — Global Teacher Prize', 'recipient' => 'Phalla NEANG, Director NISE','organization' => 'Global Teacher Prize',       'description' => 'Nominated in the top 10 best teachers in the world.',                                                       'icon' => '👩‍🏫', 'sort_order' => 3],
            ['title' => '86th Best NGO in the World',                  'recipient' => null,                        'organization' => 'Global Journal',              'description' => 'Ranked among the top 100 best NGOs in the world for global impact and operational excellence.',             'icon' => '📊', 'sort_order' => 4],
            ['title' => 'First Prize for Education in Asia-Pacific',   'recipient' => null,                        'organization' => 'Stars Foundation',            'description' => 'First prize for education in Asia-Pacific region.',                                                         'icon' => '🏆', 'sort_order' => 5],
            ['title' => 'Humanitarian Prize',                          'recipient' => null,                        'organization' => 'World of Children Award',     'description' => 'Recognised for outstanding humanitarian work with children.',                                               'icon' => '❤️', 'sort_order' => 6],
            ['title' => 'Wenhui Award for Educational Innovation',     'recipient' => null,                        'organization' => 'UNESCO',                      'description' => 'Awarded for innovative and impactful educational programs.',                                                 'icon' => '📚', 'sort_order' => 7],
            ['title' => 'Human Rights Prize',                          'recipient' => null,                        'organization' => 'French Republic',             'description' => 'Awarded by the French Republic in recognition of work promoting human rights and dignity for children.',   'icon' => '🕊️', 'sort_order' => 8],
        ];

        foreach ($awards as $award) {
            Award::updateOrCreate(['title' => $award['title']], $award);
        }

        // ── Slides ────────────────────────────────────────────
        $slides = [
            [
                'title'              => "Cultural Performance\nfor Charity",
                'subtitle'           => 'Our students showcase the beauty of Khmer arts and culture, raising awareness and funds for disadvantaged children across Cambodia.',
                'badge_text'         => 'Cultural Arts',
                'image'              => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Cambodia%2C_Angkor_Wat_%285%29.jpg/1280px-Cambodia%2C_Angkor_Wat_%285%29.jpg',
                'cta_primary_text'   => 'Learn More',
                'cta_primary_url'    => '/our-programs#culture',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url'  => '/donate',
                'sort_order'         => 1,
                'is_active'          => true,
            ],
            [
                'title'              => "Understanding Special\nEducation",
                'subtitle'           => 'A Parent Information Workshop — empowering families with knowledge and resources to support their deaf or blind children\'s education.',
                'badge_text'         => 'Special Education',
                'image'              => 'https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=1400&q=80',
                'cta_primary_text'   => 'Learn More',
                'cta_primary_url'    => '/our-programs#education',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url'  => '/donate',
                'sort_order'         => 2,
                'is_active'          => true,
            ],
            [
                'title'              => "A Home Away\nFrom Home",
                'subtitle'           => 'Family-centered care for children in need — providing safety, love, and opportunity to build a brighter future.',
                'badge_text'         => 'Child Welfare',
                'image'              => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80',
                'cta_primary_text'   => 'Learn More',
                'cta_primary_url'    => '/our-programs#welfare',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url'  => '/donate',
                'sort_order'         => 3,
                'is_active'          => true,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::updateOrCreate(['title' => $slide['title']], $slide);
        }
    }
}
