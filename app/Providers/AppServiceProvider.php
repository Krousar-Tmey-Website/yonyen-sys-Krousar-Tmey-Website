<?php

namespace App\Providers;

use App\Models\HomeSetting;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share home settings with all views for homepage stats, hero text, etc.
        view()->share('settings', HomeSetting::allKeyed());

        // Share active social links with all views (top bar, footer).
        // Check table exists first so artisan commands (migrate, route:list) work
        // before the migration has run.
        $socialLinks = Schema::hasTable('social_links')
            ? SocialLink::active()->ordered()->get()
            : collect();

        view()->share('socialLinks', $socialLinks);
    }
}
