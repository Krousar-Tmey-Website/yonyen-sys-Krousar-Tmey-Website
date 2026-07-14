<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing logs first so re-running the seeder is safe
        ActivityLog::truncate();

        $admin = User::where('is_admin', true)->first();

        if (! $admin) {
            $this->command->warn('No admin user found — skipping activity logs seed.');
            return;
        }

        $base = Carbon::now()->subDays(7);
        $logs = [];

        // Build 26 sample logs spanning the last 7 days
        $entries = [
            // Day 7 — login + partner created
            ['action' => 'login',           'desc' => 'Admin logged in',                         'subject' => null,                         'props' => [],                                                      'offset' => 0],
            ['action' => 'created',         'desc' => 'Created partner "UNICEF Cambodia"',        'subject' => ['App\\Models\\Partner', 1],   'props' => ['name' => 'UNICEF Cambodia'],                            'offset' => 10],
            ['action' => 'created',         'desc' => 'Created book "The Silent Patient"',        'subject' => ['App\\Models\\Book', 1],      'props' => ['title' => 'The Silent Patient', 'price' => 24.99],     'offset' => 30],
            ['action' => 'logout',          'desc' => 'Admin logged out',                         'subject' => null,                         'props' => [],                                                      'offset' => 120],

            // Day 6 — updates
            ['action' => 'login',           'desc' => 'Admin logged in',                         'subject' => null,                         'props' => [],                                                      'offset' => 1440],
            ['action' => 'updated',         'desc' => 'Updated book "The Silent Patient"',        'subject' => ['App\\Models\\Book', 1],      'props' => ['changes' => ['price', 'stock']],                      'offset' => 1470],
            ['action' => 'created',         'desc' => 'Created annual report "Annual Report 2025"','subject' => ['App\\Models\\AnnualReport', 1],'props' => ['year' => 2025],                                          'offset' => 1500],
            ['action' => 'updated',         'desc' => 'Updated partner "UNICEF Cambodia"',        'subject' => ['App\\Models\\Partner', 1],   'props' => ['changes' => ['description', 'website']],              'offset' => 1560],

            // Day 5 — more partner and book actions
            ['action' => 'created',         'desc' => 'Created partner "World Vision"',           'subject' => ['App\\Models\\Partner', 2],   'props' => ['name' => 'World Vision'],                              'offset' => 2880],
            ['action' => 'created',         'desc' => 'Created book "Atomic Habits"',             'subject' => ['App\\Models\\Book', 2],      'props' => ['title' => 'Atomic Habits', 'price' => 19.99],         'offset' => 2900],
            ['action' => 'updated',         'desc' => 'Updated book "Atomic Habits" stock',       'subject' => ['App\\Models\\Book', 2],      'props' => ['changes' => ['stock']],                               'offset' => 2940],
            ['action' => 'logout',          'desc' => 'Admin logged out',                         'subject' => null,                         'props' => [],                                                      'offset' => 3000],

            // Day 4 — projects
            ['action' => 'login',           'desc' => 'Admin logged in',                         'subject' => null,                         'props' => [],                                                      'offset' => 4320],
            ['action' => 'created',         'desc' => 'Created project "School Renovation"',      'subject' => ['App\\Models\\Project', 1],   'props' => ['name' => 'School Renovation', 'budget' => 50000],      'offset' => 4340],
            ['action' => 'updated',         'desc' => 'Updated project "School Renovation"',      'subject' => ['App\\Models\\Project', 1],   'props' => ['changes' => ['budget']],                              'offset' => 4380],

            // Day 3 — deletions
            ['action' => 'deleted',         'desc' => 'Deleted partner "Old Partner Name"',       'subject' => ['App\\Models\\Partner', 3],   'props' => ['name' => 'Old Partner Name'],                          'offset' => 5760],
            ['action' => 'created',         'desc' => 'Created book "Dune"',                     'subject' => ['App\\Models\\Book', 3],      'props' => ['title' => 'Dune', 'price' => 14.99],                  'offset' => 5780],
            ['action' => 'updated',         'desc' => 'Updated annual report 2025 description',   'subject' => ['App\\Models\\AnnualReport', 1],'props' => ['changes' => ['description']],                          'offset' => 5820],

            // Day 2 — bulk
            ['action' => 'login',           'desc' => 'Admin logged in',                         'subject' => null,                         'props' => [],                                                      'offset' => 7200],
            ['action' => 'created',         'desc' => 'Created partner "Save the Children"',      'subject' => ['App\\Models\\Partner', 4],   'props' => ['name' => 'Save the Children'],                         'offset' => 7220],
            ['action' => 'created',         'desc' => 'Created book "Thinking Fast and Slow"',    'subject' => ['App\\Models\\Book', 4],      'props' => ['title' => 'Thinking Fast and Slow', 'price' => 29.99],'offset' => 7240],
            ['action' => 'deleted',         'desc' => 'Deleted book "Old Manual"',               'subject' => ['App\\Models\\Book', 0],      'props' => ['title' => 'Old Manual'],                               'offset' => 7260],

            // Day 1 — recent
            ['action' => 'login',           'desc' => 'Admin logged in',                         'subject' => null,                         'props' => [],                                                      'offset' => 8640],
            ['action' => 'created',         'desc' => 'Created annual report "Annual Report 2024"','subject' => ['App\\Models\\AnnualReport', 2],'props' => ['year' => 2024],                                          'offset' => 8660],
            ['action' => 'updated',         'desc' => 'Updated book "The Silent Patient" price',  'subject' => ['App\\Models\\Book', 1],      'props' => ['changes' => ['price' => 21.99]],                       'offset' => 8680],
            ['action' => 'logout',          'desc' => 'Admin logged out',                         'subject' => null,                         'props' => [],                                                      'offset' => 8700],
        ];

        $ip = '192.168.1.1';
        $ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36';

        foreach ($entries as $i => $entry) {
            $logs[] = [
                'user_id'      => $admin->id,
                'action'       => $entry['action'],
                'subject_type' => $entry['subject'][0] ?? null,
                'subject_id'   => $entry['subject'][1] ?? null,
                'description'  => $entry['desc'],
                'properties'   => $entry['props'],
                'ip_address'   => $ip,
                'user_agent'   => $ua,
                'created_at'   => (clone $base)->addMinutes($entry['offset']),
                'updated_at'   => (clone $base)->addMinutes($entry['offset']),
            ];
        }

        foreach ($logs as $log) {
            ActivityLog::create($log);
        }

        $this->command->info('Seeded ' . count($logs) . ' sample activity logs (26 entries — split across 2 pages).');
    }
}
