<?php

namespace App\Providers;

use App\Models\Child;
use App\Models\Donation;
use App\Models\HomeSetting;
use App\Models\Program;
use App\Observers\ChildObserver;
use App\Observers\DonationObserver;
use App\Observers\ProgramObserver;
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
        if (class_exists(Program::class)) {
            Program::observe(ProgramObserver::class);
        }

        if (class_exists(Donation::class)) {
            Donation::observe(DonationObserver::class);
        }

        if (class_exists(Child::class)) {
            Child::observe(ChildObserver::class);
        }

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
