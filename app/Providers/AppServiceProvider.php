<?php

namespace App\Providers;

use App\Models\HomeSetting;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $data = $view->getData();
            if (!array_key_exists('settings', $data)) {
                try {
                    $view->with('settings', HomeSetting::allKeyed());
                } catch (\Throwable $e) {
                    $view->with('settings', []);
                }
            }
        });
    }
}
