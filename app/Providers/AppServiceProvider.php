<?php

namespace App\Providers;

use App\Models\AnnualReport;
use App\Models\Award;
use App\Models\Book;
use App\Models\Campaign;
use App\Models\Child;
use App\Models\ContactInquiry;
use App\Models\CoreValue;
use App\Models\Donation;
use App\Models\HistoryEvent;
use App\Models\HomeSetting;
use App\Models\ImpactStatistic;
use App\Models\JobOpportunity;
use App\Models\News;
use App\Models\NewsletterSubscriber;
use App\Models\Office;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\PresentationSlide;
use App\Models\PrincipleSlide;
use App\Models\Program;
use App\Models\ProgramPage;
use App\Models\ProgramPageItem;
use App\Models\Project;
use App\Models\ProjectGrant;
use App\Models\Slide;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\WorldwidePartner;
use App\Observers\ModelActivityObserver;
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
        $observedModels = [
            AnnualReport::class,
            Award::class,
            Book::class,
            Campaign::class,
            Child::class,
            ContactInquiry::class,
            CoreValue::class,
            Donation::class,
            HistoryEvent::class,
            HomeSetting::class,
            ImpactStatistic::class,
            JobOpportunity::class,
            News::class,
            NewsletterSubscriber::class,
            Office::class,
            PageSection::class,
            Partner::class,
            PresentationSlide::class,
            PrincipleSlide::class,
            Program::class,
            ProgramPage::class,
            ProgramPageItem::class,
            Project::class,
            ProjectGrant::class,
            Slide::class,
            Testimonial::class,
            User::class,
            Volunteer::class,
            WorldwidePartner::class,
        ];

        foreach ($observedModels as $model) {
            if (class_exists($model)) {
                $model::observe(ModelActivityObserver::class);
            }
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
