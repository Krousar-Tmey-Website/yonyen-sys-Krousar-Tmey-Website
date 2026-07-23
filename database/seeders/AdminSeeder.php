<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\HomeSetting;
use App\Enums\PartnerCategory;
use App\Enums\PartnerSubcategory;
use App\Models\Partner;
use App\Models\Program;
use App\Models\ProgramPageItem;
use App\Models\Project;
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
                'name' => 'Krousar Thmey Admin',
                'password' => Hash::make('Admin@KT2024'),
                'is_admin' => true,
            ]
        );

        // ── Home settings ─────────────────────────────────────
        $homeSettings = [
            // Website identity group
            ['key' => 'site_name',        'label' => 'Website Name',           'group' => 'website', 'value' => 'Krousar Thmey'],
            ['key' => 'site_tagline',     'label' => 'Website Tagline',        'group' => 'website', 'value' => 'គ្រួសារថ្មី · New Family'],
            ['key' => 'site_logo',        'label' => 'Site Logo (path)',       'group' => 'website', 'value' => 'images/logo.png'],
            ['key' => 'site_description', 'label' => 'Meta Description',       'group' => 'website', 'value' => "Krousar Thmey is Cambodia's first organization dedicated to helping disadvantaged children — through child welfare, special education, and cultural development."],
            // Footer website settings (also in footer group for footer card)
            ['key' => 'footer_copyright',  'label' => 'Footer Copyright Text',  'group' => 'footer', 'value' => 'Krousar Thmey. All rights reserved.'],
            ['key' => 'footer_description','label' => 'Footer Brand Description', 'group' => 'footer', 'value' => "Cambodia's first organization helping disadvantaged children — building a world where every child grows into an independent, responsible adult."],
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
            ['key' => 'cta_subtitle',        'label' => 'CTA Subtitle',        'group' => 'cta', 'value' => 'We guarantee that 100% of your donation is used to support children across Cambodia. Every contribution, big or small, changes a life.'],
            ['key' => 'cta_primary_text',    'label' => 'CTA Primary Button Text',   'group' => 'cta', 'value' => 'Donate Now'],
            ['key' => 'cta_primary_url',     'label' => 'CTA Primary Button URL',   'group' => 'cta', 'value' => '/donate'],
            ['key' => 'cta_secondary_text',  'label' => 'CTA Secondary Button Text', 'group' => 'cta', 'value' => 'Get Involved'],
            ['key' => 'cta_secondary_url',   'label' => 'CTA Secondary Button URL', 'group' => 'cta', 'value' => '/get-involved'],
            // Structure map
            ['key' => 'structure_heading',       'label' => 'Structure Map — Heading',            'group' => 'structure', 'value' => "KROUSAR THMEY'S STRUCTURES"],
            ['key' => 'structure_welfare_title', 'label' => 'Structure Map — Child Welfare Title', 'group' => 'structure', 'value' => 'Child Welfare Program'],
            ['key' => 'structure_welfare_items', 'label' => 'Structure Map — Child Welfare Items', 'group' => 'structure', 'value' => "2 Temporary Protection Centers\n2 Long-term Protection Centers\n2 Family Houses\nOutside Cases"],
            ['key' => 'structure_education_title', 'label' => 'Structure Map — Education Title',    'group' => 'structure', 'value' => 'Education for Deaf or Blind Children Program'],
            ['key' => 'structure_education_items', 'label' => 'Structure Map — Education Items',    'group' => 'structure', 'value' => '5 Special Education High Schools'],
            ['key' => 'structure_image',         'label' => 'Structure Map — Image URL',           'group' => 'structure', 'value' => asset('images/cambodia-map.png')],
            // Programs section
            ['key' => 'programs_badge',  'label' => 'Programs — Badge Text', 'group' => 'programs', 'value' => 'WHAT WE DO'],
            ['key' => 'programs_heading', 'label' => 'Programs — Heading',     'group' => 'programs', 'value' => 'Two Programs, One Mission'],
            ['key' => 'programs_cta',    'label' => 'Programs — CTA Button',  'group' => 'programs', 'value' => 'View All Programs'],
            ['key' => 'programs_learn_btn', 'label' => 'Programs — Card Learn More Button', 'group' => 'programs', 'value' => 'Learn More'],
            // Partners section
            ['key' => 'partners_heading', 'label' => 'Partners — Section Heading', 'group' => 'partners', 'value' => 'Supported by Our Partners Worldwide'],
            // Footer contact
            ['key' => 'footer_address', 'label' => 'Footer Address', 'group' => 'footer', 'value' => '#58, Street 478, Phnom Penh, Cambodia'],
            ['key' => 'footer_phone',   'label' => 'Footer Phone',   'group' => 'footer', 'value' => '+855 (0)23 211 955'],
            ['key' => 'footer_email',   'label' => 'Footer Email',   'group' => 'footer', 'value' => 'info@krousar-thmey.org'],
            // Social media links (header & footer)
            ['key' => 'social_facebook',   'label' => 'Facebook URL',    'group' => 'social', 'value' => 'https://www.facebook.com/KrousarThmey'],
            ['key' => 'social_instagram',  'label' => 'Instagram URL',   'group' => 'social', 'value' => 'https://www.instagram.com/krousarthmey/'],
            ['key' => 'social_linkedin',   'label' => 'LinkedIn URL',    'group' => 'social', 'value' => 'https://www.linkedin.com/company/krousar-thmey/'],
            ['key' => 'social_youtube',    'label' => 'YouTube URL',     'group' => 'social', 'value' => 'https://www.youtube.com/@KrousarThmey'],
            ['key' => 'social_telegram',   'label' => 'Telegram URL',    'group' => 'social', 'value' => 'https://t.me/krousarthmey'],
            ['key' => 'social_facebook_icon',  'label' => 'Facebook Icon',  'group' => 'social', 'value' => 'images/social/facebook.svg'],
            ['key' => 'social_instagram_icon', 'label' => 'Instagram Icon', 'group' => 'social', 'value' => 'images/social/instagram.svg'],
            ['key' => 'social_linkedin_icon',  'label' => 'LinkedIn Icon',  'group' => 'social', 'value' => 'images/social/linkedin.svg'],
            ['key' => 'social_youtube_icon',   'label' => 'YouTube Icon',   'group' => 'social', 'value' => 'images/social/youtube.svg'],
            ['key' => 'social_telegram_icon',  'label' => 'Telegram Icon',  'group' => 'social', 'value' => 'images/social/telegram.svg'],
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
            // Programs Banner group
            ['key' => 'programs_banner_title',    'label' => 'Banner Title',    'group' => 'programs_banner', 'value' => 'Our Programs'],
            ['key' => 'programs_banner_subtitle',  'label' => 'Banner Subtitle', 'group' => 'programs_banner', 'value' => 'Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.'],
            ['key' => 'programs_banner_image',     'label' => 'Banner Background Image (URL or upload path)', 'group' => 'programs_banner', 'value' => ''],
            // Project defaults group
            ['key' => 'project_default_area_of_work', 'label' => 'Default Area of Work', 'group' => 'project_defaults', 'value' => 'Child protection'],
            ['key' => 'project_default_duration', 'label' => 'Default Duration', 'group' => 'project_defaults', 'value' => 'Undetermined'],
            ['key' => 'project_default_location', 'label' => 'Default Location', 'group' => 'project_defaults', 'value' => 'Cambodia'],
            ['key' => 'project_default_beneficiaries', 'label' => 'Default Beneficiaries', 'group' => 'project_defaults', 'value' => 'Marginalized children and youth'],
            ['key' => 'project_default_make_difference_text', 'label' => 'Default Make a Difference Text', 'group' => 'project_defaults', 'value' => '$50 - food expenses per child per month'],
            // Donation tiers group
            ['key' => 'donation_tier_1_amount', 'label' => 'Tier 1 — Amount',      'group' => 'donation_tiers', 'value' => '€15'],
            ['key' => 'donation_tier_1_desc',   'label' => 'Tier 1 — Description', 'group' => 'donation_tiers', 'value' => 'School supplies for one student / month'],
            ['key' => 'donation_tier_1_icon',   'label' => 'Tier 1 — Icon (emoji)', 'group' => 'donation_tiers', 'value' => '📚'],
            ['key' => 'donation_tier_2_amount', 'label' => 'Tier 2 — Amount',      'group' => 'donation_tiers', 'value' => '€30'],
            ['key' => 'donation_tier_2_desc',   'label' => 'Tier 2 — Description', 'group' => 'donation_tiers', 'value' => 'Food for a child in our care / month'],
            ['key' => 'donation_tier_2_icon',   'label' => 'Tier 2 — Icon (emoji)', 'group' => 'donation_tiers', 'value' => '🍚'],
            ['key' => 'donation_tier_3_amount', 'label' => 'Tier 3 — Amount',      'group' => 'donation_tiers', 'value' => '€60'],
            ['key' => 'donation_tier_3_desc',   'label' => 'Tier 3 — Description', 'group' => 'donation_tiers', 'value' => "Deaf student's education / month"],
            ['key' => 'donation_tier_3_icon',   'label' => 'Tier 3 — Icon (emoji)', 'group' => 'donation_tiers', 'value' => '👂'],
            ['key' => 'donation_tier_4_amount', 'label' => 'Tier 4 — Amount',      'group' => 'donation_tiers', 'value' => '€100'],
            ['key' => 'donation_tier_4_desc',   'label' => 'Tier 4 — Description', 'group' => 'donation_tiers', 'value' => 'Vocational training for a young adult'],
            ['key' => 'donation_tier_4_icon',   'label' => 'Tier 4 — Icon (emoji)', 'group' => 'donation_tiers', 'value' => '🎓'],
            // About page
            ['key' => 'about_worldwide_title', 'label' => 'Worldwide Section Title', 'group' => 'about', 'value' => 'Krousar Thmey Worldwide'],
            ['key' => 'about_worldwide_desc',  'label' => 'Worldwide Section Description', 'group' => 'about', 'value' => 'Krousar Thmey benefits from the support of various entities around the world. Their fundraising and communication networks greatly contribute to the success of all programs and projects.'],
            // Transparency page
            ['key' => 'transparency_title', 'label' => 'Page Title', 'group' => 'transparency', 'value' => 'Transparency and Accountability'],
            ['key' => 'transparency_financial_heading', 'label' => 'Financial Transparency — Heading', 'group' => 'transparency', 'value' => 'Financial Transparency'],
            ['key' => 'transparency_financial_p1', 'label' => 'Financial Transparency — Paragraph 1', 'group' => 'transparency', 'value' => 'Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used.'],
            ['key' => 'transparency_financial_p2', 'label' => 'Financial Transparency — Paragraph 2', 'group' => 'transparency', 'value' => 'The implementation of programs and projects is our priority.'],
            ['key' => 'transparency_financial_p3', 'label' => 'Financial Transparency — Paragraph 3', 'group' => 'transparency', 'value' => 'Thanks to the strict financial management and the involvement of European volunteers, all administrative costs remain under 4% of the total budget.'],
            ['key' => 'transparency_financial_p4', 'label' => 'Financial Transparency — Paragraph 4', 'group' => 'transparency', 'value' => "Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (PricewaterhouseCoopers since 2013 and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes in order to provide greater efficiency to the organization and transparency to its partners."],
            ['key' => 'transparency_financial_list_intro', 'label' => 'Financial Transparency — Line Before Report List', 'group' => 'transparency', 'value' => 'Audited financial statements are available here:'],
            ['key' => 'transparency_financial_outro', 'label' => 'Financial Transparency — Closing Line', 'group' => 'transparency', 'value' => "Our French and Swiss organisations' accounts are also audited annually."],
            ['key' => 'transparency_origins_heading', 'label' => 'Origins Of The Funds — Heading', 'group' => 'transparency', 'value' => 'Origins Of The Funds'],
            ['key' => 'transparency_origins_p1', 'label' => 'Origins Of The Funds — Paragraph 1', 'group' => 'transparency', 'value' => 'In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.'],
            ['key' => 'transparency_origins_p2', 'label' => 'Origins Of The Funds — Paragraph 2', 'group' => 'transparency', 'value' => 'Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.'],
            ['key' => 'transparency_origins_p3', 'label' => 'Origins Of The Funds — Paragraph 3', 'group' => 'transparency', 'value' => "Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey's resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement."],
            ['key' => 'transparency_award_prefix', 'label' => 'Award Line — Prefix', 'group' => 'transparency', 'value' => 'Krousar Thmey won the'],
            ['key' => 'transparency_award_link_label', 'label' => 'Award Line — Link Label', 'group' => 'transparency', 'value' => 'label Ideas'],
            ['key' => 'transparency_award_link_url', 'label' => 'Award Line — Link URL', 'group' => 'transparency', 'value' => 'https://ideas.asso.fr/'],
            ['key' => 'transparency_award_suffix', 'label' => 'Award Line — Suffix', 'group' => 'transparency', 'value' => 'in 2010.'],
        ];

        foreach ($homeSettings as $setting) {
            HomeSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // ── Programs ──────────────────────────────────────────
        $programs = [
            ['title' => 'Child Welfare',                       'slug' => 'child-welfare',     'image' => 'children.jpg',  'description' => 'Providing safe family-based care for vulnerable and orphaned children.'],
            ['title' => 'Education for Deaf or Blind Children', 'slug' => 'special-education', 'image' => 'special-ed.jpg', 'description' => 'Specialised schooling and integration into mainstream education.'],
            ['title' => 'Cultural and Artistic Development',    'slug' => 'cultural-arts',     'image' => 'cultural.jpg',  'description' => 'Reconnecting children with Khmer traditions through arts and shadow theatre.'],
            ['title' => 'Academic and Career Counseling',       'slug' => 'career-counseling', 'image' => 'program.jpg',   'description' => 'Supporting access to higher education, training, and employment.'],
            ['title' => 'Health and Hygiene',                   'slug' => 'health-hygiene',    'image' => 'hygiene.jpg',   'description' => 'Promoting health education and sanitation practices.'],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], array_merge($prog, ['is_active' => true]));
        }

        // ── Child Welfare — full content, testimony & projects ─
        $childWelfare = Program::where('slug', 'child-welfare')->first();

        if ($childWelfare) {
            $childWelfare->update([
                'description' => 'Facilitate the reintegration of marginalized children into their families and society through emotional, educational and material support.',
                'full_description' => "Victims of neglect, poverty, trafficking or difficult family situations, street children constitute a vulnerable, out-of-school, often traumatized and marginalized population. The Child Welfare program, which helps children and their families by providing emotional, educational and material support, aims to create the necessary conditions for them to build a better future.\n\nKrousar Thmey has three types of structures adapted to the child's needs, age and family situation: temporary protection centers, long-term protection centers and family houses. Family reintegration is always favored whenever possible.",
                'testimony_name' => 'Davann, 17, welcomed in Siem Reap protection center',
                'testimony_story' => 'Davann arrived in Siem Reap long-term protection center in March 2017, following the closure of NGO Homeland Cambodia in Battambang Province. After her parents divorced, her mother emigrated to Thailand to find work and Davann was separated from her family. "I feel happy about living in the center. If not for Krousar Thmey, I think I wouldn\'t have had the chance to go to school and have access to so many things. I feel luckier than other children." A serious student, Davann is already looking forward to passing Grade 12 exams and accessing higher education. "I would like to study at university and become a lawyer because I want to help others."',
            ]);

            $childWelfareProjects = [
                [
                    'title' => 'Temporary Protection Centers',
                    'description' => 'To offer a stable and reassuring accommodation solution to the child before considering reintegration into their family.',
                ],
                [
                    'title' => 'Long-term Protection Centers',
                    'description' => 'To ensure a stable environment for the child and provide them with access to education, in order to facilitate their integration into Cambodian society.',
                ],
                [
                    'title' => 'Family Houses',
                    'description' => 'To welcome children into a safe and caring environment, tailored to their needs.',
                ],
                [
                    'title' => 'Academic and Career Counseling',
                    'description' => 'To support young Cambodians in building their future by facilitating access to higher education, vocational training and employment.',
                ],
            ];

            foreach ($childWelfareProjects as $proj) {
                Project::updateOrCreate(
                    ['title' => $proj['title'], 'program_id' => $childWelfare->id],
                    array_merge($proj, ['is_active' => true])
                );
            }
        }

        $this->seedPartners();

        // ── Program Page Items ──────────────────────────────────
        ProgramPageItem::updateOrCreate(
            ['title' => 'Transfer of Krousar Thmey Schools to the Cambodian Authorities'],
            [
                'objective' => 'To enable children with disabilities to be integrated into the Cambodian educational system and thus provide greater equality of opportunity for all children.',
                'detail_content' => '<p>Initiated in 2011, the transfer of specialized schools to the Cambodian authorities was formalized at the start of the school year in November 2018. The schools have now become public institutions, under the strategic leadership of the Department of Special Education (DSE) of the Ministry of Education, Youth and Sports. Like all public schools, their budgetary and administrative management is decentralized to the provincial education offices from which they report.</p>'
                    . '<p>In parallel, the National Institute for Special Education (NISE), created in 2017 and headed by Mrs. Phalla NEANG, former coordinator of the education program for blind children of Krousar Thmey, is now officially operational. Mainly in charge of the training of specialized teachers and the development of curricula, it is also interested in the production of adapted resources. The Braille workshop and the Sign Language Committee are under its responsibility.</p>'
                    . '<p><a href="' . route('programs.show', 'special-education', false) . '">Learn more about the teacher training project &rarr;</a></p>'
                    . '<p>In order to better support this transition, Krousar Thmey retains a role as technical advisor to the ministry in terms of teaching practices, the status of staff, and adapted care of students with disabilities. The Foundation also continues to carry out various projects for the creation of educational tools and resources, the screening and the inclusion of children with disabilities.</p>',
                'is_active' => true,
                'sort_order' => 0,
            ]
        );

        // ── Awards ────────────────────────────────────────────
        $awards = [
            ['title' => 'Hero Award',                                  'recipient' => 'Benoît Duchâteau-Arminjon', 'organization' => 'World of Children',          'description' => 'Awarded for the long-lasting impact of the actions conducted by former honorees.',                          'sort_order' => 1],
            ['title' => 'Trophy for French Living Abroad',             'recipient' => 'Benoît Duchâteau-Arminjon', 'organization' => 'French Republic',            'description' => 'Humanitarian and social category.',                                                                         'sort_order' => 2],
            ['title' => 'Top 10 Best Teachers — Global Teacher Prize', 'recipient' => 'Phalla NEANG, Director NISE', 'organization' => 'Global Teacher Prize',       'description' => 'Nominated in the top 10 best teachers in the world.',                                                       'sort_order' => 3],
            ['title' => '86th Best NGO in the World',                  'recipient' => null,                        'organization' => 'Global Journal',              'description' => 'Ranked among the top 100 best NGOs in the world for global impact and operational excellence.',             'sort_order' => 4],
            ['title' => 'First Prize for Education in Asia-Pacific',   'recipient' => null,                        'organization' => 'Stars Foundation',            'description' => 'First prize for education in Asia-Pacific region.',                                                         'sort_order' => 5],
            ['title' => 'Humanitarian Prize',                          'recipient' => null,                        'organization' => 'World of Children Award',     'description' => 'Recognised for outstanding humanitarian work with children.',                                               'sort_order' => 6],
            ['title' => 'Wenhui Award for Educational Innovation',     'recipient' => null,                        'organization' => 'UNESCO',                      'description' => 'Awarded for innovative and impactful educational programs.',                                                 'sort_order' => 7],
            ['title' => 'Human Rights Prize',                          'recipient' => null,                        'organization' => 'French Republic',             'description' => 'Awarded by the French Republic in recognition of work promoting human rights and dignity for children.',   'sort_order' => 8],
        ];

        foreach ($awards as $award) {
            Award::updateOrCreate(['title' => $award['title']], $award);
        }

        // ── Slides ────────────────────────────────────────────
        $slides = [
            [
                'title' => "Cultural Performance\nfor Charity",
                'subtitle' => 'Our students showcase the beauty of Khmer arts and culture, raising awareness and funds for disadvantaged children across Cambodia.',
                'badge_text' => 'Cultural Arts',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Cambodia%2C_Angkor_Wat_%285%29.jpg/1280px-Cambodia%2C_Angkor_Wat_%285%29.jpg',
                'cta_primary_text' => 'Learn More',
                'cta_primary_url' => '/our-programs#culture',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url' => '/donate',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => "Understanding Special\nEducation",
                'subtitle' => 'A Parent Information Workshop — empowering families with knowledge and resources to support their deaf or blind children\'s education.',
                'badge_text' => 'Special Education',
                'image' => 'https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=1400&q=80',
                'cta_primary_text' => 'Learn More',
                'cta_primary_url' => '/our-programs#education',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url' => '/donate',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => "A Home Away\nFrom Home",
                'subtitle' => 'Family-centered care for children in need — providing safety, love, and opportunity to build a brighter future.',
                'badge_text' => 'Child Welfare',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80',
                'cta_primary_text' => 'Learn More',
                'cta_primary_url' => '/our-programs#welfare',
                'cta_secondary_text' => 'Donate Now',
                'cta_secondary_url' => '/donate',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::updateOrCreate(['title' => $slide['title']], $slide);
        }
    }

    /**
     * Seed (or repair) partner rows and their category/subcategory assignment.
     * Safe to call on its own — matches existing rows by name, so re-running
     * never duplicates data.
     */
    public function seedPartners(): void
    {
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
            // Individual Donors (no category — shows under 'Individual Donor' filter)
            ['name' => 'Peter Tschofen, Individual Donor',                     'category' => null, 'sort_order' => 100],
            ['name' => 'Suzanne ROY, Grants Barbe, Individual Donor',          'category' => null, 'sort_order' => 101],
            ['name' => 'Sophie Delacroix, Private Supporter',                  'category' => null, 'sort_order' => 102],
            ['name' => 'James & Margaret Thornton Foundation',                 'category' => null, 'sort_order' => 103],
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
            ['name' => 'THALIAS (Malis, Khema, Arunreas Hotel)', 'category' => 'companies', 'sort_order' => 24],
            ['name' => 'TOP STREET RESTAURANT',                 'category' => 'companies', 'sort_order' => 25],
            ['name' => 'VOICE OF THE BLIND Radio station',      'category' => 'companies', 'sort_order' => 26],
            // Towns
            ['name' => 'City of Geneva',                                              'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 1],
            ['name' => 'City of Meyrin',                                              'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 2],
            ['name' => 'Town of Hermance',                                            'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 3],
            ['name' => 'Towns of Collonge-Bellerive, Hermance and Vandoeuvres',      'category' => 'towns', 'country' => 'Switzerland', 'sort_order' => 4],
        ];

        // Technical Partners have no subcategory.
        $technicalPartners = [
            ['name' => 'Enfants Sourds du Cambodge',   'logo' => 'partners/technical-partner-1.webp', 'sort_order' => 1],
            ['name' => 'Friends International',        'logo' => 'partners/technical-partner-2.webp', 'sort_order' => 2],
            ['name' => 'Deaf Development Programme',   'logo' => 'partners/technical-partner-3.webp', 'sort_order' => 3],
            ['name' => 'Cambodian Living Arts',         'logo' => 'partners/technical-partner-4.webp', 'sort_order' => 4],
            ['name' => 'Sipar',                         'logo' => 'partners/technical-partner-5.webp', 'sort_order' => 5],
            ['name' => 'Save the Children',             'logo' => 'partners/technical-partner-6.webp', 'sort_order' => 6],
        ];

        // Old seed key ('authorities', ...) → Financial Partner subcategory.
        $subcategoryMap = [
            'authorities'   => PartnerSubcategory::CambodianPublicAuthorities->value,
            'organizations' => PartnerSubcategory::OrganizationsFoundationsInstitutions->value,
            'companies'     => PartnerSubcategory::Companies->value,
            'towns'         => PartnerSubcategory::TownsAndMunicipalities->value,
        ];

        foreach ($partners as $partner) {
            $partnerData = $partner;
            $key = $partnerData['category'];
            unset($partnerData['category']);

            if ($key === null) {
                // Individual donor — no main category assigned.
                $partnerData['category'] = null;
                $partnerData['subcategory'] = null;

                Partner::updateOrCreate(
                    ['name' => $partner['name']],
                    array_merge($partnerData, ['is_active' => true])
                );
                continue;
            }

            $partnerData['category'] = PartnerCategory::Financial->value;
            $partnerData['subcategory'] = $subcategoryMap[$key] ?? null;

            Partner::updateOrCreate(
                ['name' => $partner['name']],
                array_merge($partnerData, ['is_active' => true])
            );
        }

        foreach ($technicalPartners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                array_merge($partner, [
                    'category'    => PartnerCategory::Technical->value,
                    'subcategory' => null,
                    'is_active'   => true,
                ])
            );
        }
    }
}
