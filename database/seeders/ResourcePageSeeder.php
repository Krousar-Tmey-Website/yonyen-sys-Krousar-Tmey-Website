<?php

namespace Database\Seeders;

use App\Models\ResourcePage;
use Illuminate\Database\Seeder;

class ResourcePageSeeder extends Seeder
{
    /**
     * The Topics that News tags link to. Snapshotted from the working
     * database so every environment/teammate gets the same set instead
     * of having to recreate them by hand.
     */
    public function run(): void
    {
        $pages = array (
  0 => 
  array (
    'title' => 'Krousar Thmey',
    'slug' => 'krousar-thmey',
    'description' => 'Cambodia\'s first organization helping disadvantaged children — learn more about who we are.',
    'image' => 'resource-pages/mzhzNRmwx0QXVzvLGjPpkv6dXZkLvh7q1qeGdJCr.jpg',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 1,
    'is_active' => true,
  ),
  1 => 
  array (
    'title' => 'Academic and Career Counselling',
    'slug' => 'academic-and-career-counselling',
    'description' => 'Supporting young Cambodians in building their future through education and career guidance.',
    'image' => 'resource-pages/N0c1DMmPtm05o7kCSqnDr2PpGc1DjKrDPKJb9UFL.png',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 1,
    'is_active' => true,
  ),
  2 => 
  array (
    'title' => 'Cambodia',
    'slug' => 'cambodia',
    'description' => NULL,
    'image' => 'resource-pages/4NASg3T3Lxf5BZXVstS1boe2KetX4XzBAuU3njDj.jpg',
    'header_text' => 'Success story of Income Generation Activity of Krousar Thmey',
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 1,
    'is_active' => true,
  ),
  3 => 
  array (
    'title' => 'Child Welfare',
    'slug' => 'child-welfare',
    'description' => 'Providing safe, family-based care for vulnerable and orphaned children.',
    'image' => 'resource-pages/2EQ8VdRsL3SqMx2NqkYIJP42OfAd5Q9m8oRfjbq4.png',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 3,
    'is_active' => true,
  ),
  4 => 
  array (
    'title' => 'Cultural and Artistic Development',
    'slug' => 'cultural-and-artistic-development',
    'description' => 'Reconnecting children with Khmer traditions through arts and shadow theatre.',
    'image' => 'resource-pages/44LdQD1NP5wnS3VbSOcjYubpIBLGsmy0WweKfY8g.jpg',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 4,
    'is_active' => true,
  ),
  5 => 
  array (
    'title' => 'Education for Deaf and Blind Children',
    'slug' => 'education-for-deaf-and-blind-children',
    'description' => 'Specialised schooling and integration into mainstream education for deaf and blind children.',
    'image' => 'resource-pages/Y3uIQYSv3dBHWphgIGZnIIkHjuO1v485IabhOAS1.jpg',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 5,
    'is_active' => true,
  ),
  6 => 
  array (
    'title' => 'France',
    'slug' => 'france',
    'description' => 'Krousar Thmey\'s partners and supporters in France.',
    'image' => 'resource-pages/OMj7i7LcHe2HddXmt6vtig8tJp1t0B9JULQsDmMo.png',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 6,
    'is_active' => true,
  ),
  7 => 
  array (
    'title' => 'Health and Hygiene',
    'slug' => 'health-and-hygiene',
    'description' => 'Promoting health education and sanitation practices in our programs.',
    'image' => 'resource-pages/GGU2322WXhXQEi8hEiqooGN3Q37sOfzRbNiLN0i8.png',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 7,
    'is_active' => true,
  ),
  8 => 
  array (
    'title' => 'Non classifié(e)',
    'slug' => 'non-classifiee',
    'description' => NULL,
    'image' => 'resource-pages/XDhspCtFt73E8tkk5Nrzpy28vqSukEZX7tHy2Fmw.jpg',
    'header_text' => NULL,
    'detail_image' => NULL,
    'detail_description' => NULL,
    'items' => 
    array (
    ),
    'sort_order' => 8,
    'is_active' => true,
  ),
);

        foreach ($pages as $page) {
            ResourcePage::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
