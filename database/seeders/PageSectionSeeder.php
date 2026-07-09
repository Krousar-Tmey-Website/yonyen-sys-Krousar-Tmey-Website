<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageSection;
use App\Models\Image;
use App\Models\Link;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | FOCUS SECTION
        |--------------------------------------------------------------------------
        */

        $focus = PageSection::create([
            'section_name' => 'focus',

            'title' => 'The social workers of the Child Welfare Program',

            'description' => 
            "Victims of neglect, poverty, trafficking or difficult family situations, street children constitute a vulnerable and marginalized population.

Krousar Thmey’s social workers conduct outreach sessions in high-risk areas to identify children living on the streets and their families. Once the family and the child agree to join one of Krousar Thmey’s protection structures, the organization makes sure that the children grow up in a safe and stable environment, while supporting the families to improve their living conditions.",

            'order' => 1,
            'active' => true,
        ]);


        Image::create([
            'section_id' => $focus->id,
            'path' => 'uploads/page_sections/focus.jpg',
            'alt' => 'The social workers of the Child Welfare Program',
            'order' => 1,
        ]);


        Link::insert([
            [
                'section_id' => $focus->id,
                'text' => 'SUPPORT US',
                'url' => '/donate',
                'type' => 'button',
                'target' => '_self',
                'order' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'section_id' => $focus->id,
                'text' => 'Read more',
                'url' => '/en/child-welfare/temporary-centers/',
                'type' => 'button',
                'target' => '_self',
                'order' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);



        /*
        |--------------------------------------------------------------------------
        | VIDEO SECTION
        |--------------------------------------------------------------------------
        */

        $video = PageSection::create([
            'section_name' => 'video',

            'title' => 'DISCOVER KROUSAR THMEY IN VIDEO',

            'description' =>
            "To better understand the action of the Foundation, all you need is 3 minutes!

Watch this short video and many others on our YouTube channel.",

            'order' => 2,
            'active' => true,
        ]);


        Image::create([
            'section_id' => $video->id,
            'path' => 'uploads/page_sections/video-thumbnail.jpg',
            'alt' => 'Krousar Thmey in 3 minutes',
            'order' => 1,
        ]);


        Link::insert([
            [
                'section_id' => $video->id,
                'text' => 'YouTube channel',
                'url' => 'https://www.youtube.com/channel/UCpAN_C5nP7_VA9Pg5DekAiw',
                'type' => 'external',
                'target' => '_blank',
                'order' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'section_id' => $video->id,
                'text' => 'Watch Video',
                'url' => 'https://www.youtube.com/watch?v=8mEDuKsY4jU',
                'type' => 'video',
                'target' => '_blank',
                'order' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}