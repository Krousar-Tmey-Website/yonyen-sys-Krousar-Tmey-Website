<?php

namespace App\Providers;

use App\Models\HomeSetting;
use Illuminate\Support\ServiceProvider;

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
        // Share home settings with all views so social links (and other settings)
        // are available everywhere — including the layout.
        view()->share('settings', HomeSetting::allKeyed());
    }
}
