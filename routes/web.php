<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\VolunteerController;
use App\Models\AnnualReport;
use App\Models\Award;
use App\Models\Book;
use App\Models\CoreValue;
use App\Models\Gallery;
use App\Models\HistoryEvent;
use App\Models\HomeSetting;
use App\Models\MapProject;
use App\Models\JobOpportunity;
use App\Models\News;
use App\Enums\PartnerCategory;
use App\Enums\PartnerSubcategory;
use App\Models\Office;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Program;
use App\Models\ProgramPageItem;
use App\Models\Project;
use App\Http\Controllers\ResourcePageController;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// ──────────────────────────────────────────────
// Public Routes
// ──────────────────────────────────────────────

// ──────────────────────────────────────────────
// Admin — Auth (no middleware)
// ──────────────────────────────────────────────

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    $settings = HomeSetting::allKeyed();
    $latestNews = News::published()->latest('published_at')->take(3)->get();
    $slides = Slide::active()->get();
    $projects = Project::where('is_active', true)->take(3)->get();
    $testimonials = Testimonial::where('is_active', true)->take(3)->get();
    $galleries = Gallery::where('is_active', true)->latest()->take(6)->get();
    $programs = Program::active()->take(3)->get();
    $pageSections = PageSection::where('active', true)->with(['images', 'links'])->orderBy('order')->get();
    $impactStatistics = \App\Models\ImpactStatistic::active()->orderBy('sort_order')->get();
    $sponsors = \App\Models\Sponsor::active()->orderBy('sort_order')->get();
    $mapProjects = MapProject::getFrontendData();

    return view('home', compact('settings', 'latestNews', 'slides', 'projects', 'testimonials', 'galleries', 'programs', 'pageSections', 'impactStatistics', 'sponsors', 'mapProjects'));
})->name('home');

Route::get('/who-we-are', function () {
    $awards = Award::active()->ordered()->get();
    $offices = collect(config('offices'))->map(fn ($o) => (object) $o);
    $historyEvents = HistoryEvent::active()->get();
    $reports = AnnualReport::active()->get();
    $settings = HomeSetting::allKeyed();
    $coreValues = CoreValue::ordered()->get();

    $technicalPartners = Partner::active()->where('category', PartnerCategory::Technical->value)->get();

    $financialPartnersBySubcategory = Partner::active()
        ->where('category', PartnerCategory::Financial->value)
        ->get()
        ->groupBy('subcategory');

    $transferProgramItem = ProgramPageItem::active()
        ->where('title', 'Transfer of Krousar Thmey Schools to the Cambodian Authorities')
        ->first();

    return view('about', compact(
        'awards', 'offices', 'historyEvents', 'reports', 'settings', 'coreValues',
        'technicalPartners', 'financialPartnersBySubcategory', 'transferProgramItem'
    ));
})->name('about');

// Who We Are - Sub-pages
Route::get('/who-we-are/presentation', function () {
    $settings = HomeSetting::allKeyed();
    $coreValues = CoreValue::ordered()->get();
    $offices = collect(config('offices'))->reject(fn ($o) => $o['country'] === 'Cambodia')->map(fn ($o) => (object) $o);
    $impactStatistics = \App\Models\ImpactStatistic::active()->get();

    return view('presentation', compact('settings', 'coreValues', 'offices', 'impactStatistics'));
})->name('presentation');

Route::get('/who-we-are/transparency', function () {
    $settings = HomeSetting::allKeyed();
    $reports = AnnualReport::active()->get();

    return view('transparency', compact('settings', 'reports'));
})->name('transparency');

Route::get('/our-programs', function () {
    $programs = Program::active()->with(['projects' => function ($q) {
        $q->where('is_active', true)->orderBy('id');
    }])->get();
    $bannerTitle = HomeSetting::getValue('programs_banner_title', 'Our Programs');
    $bannerSubtitle = HomeSetting::getValue('programs_banner_subtitle', 'Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.');
    $bannerImage = HomeSetting::getValue('programs_banner_image', '');
    
    $additionalLabel = HomeSetting::getValue('programs_additional_label', 'Cross-cutting Work');
    $additionalTitle = HomeSetting::getValue('programs_additional_title', 'Additional Programs');
    
    $infoLabel = HomeSetting::getValue('programs_info_label', 'Learn More');
    $infoTitle = HomeSetting::getValue('programs_info_title', 'Additional Information');
    
    $ctaLabel = HomeSetting::getValue('programs_cta_label', 'Support Our Mission');
    $ctaTitle = HomeSetting::getValue('programs_cta_title', 'Help Children in Cambodia');
    $ctaSubtitle = HomeSetting::getValue('programs_cta_subtitle', 'Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.');

    return view('programs', compact('programs', 'bannerTitle', 'bannerSubtitle', 'bannerImage', 'additionalLabel', 'additionalTitle', 'infoLabel', 'infoTitle', 'ctaLabel', 'ctaTitle', 'ctaSubtitle'));
})->name('programs');

Route::get('/our-programs/{slug}', function ($slug) {
    // Redirect all old individual program links to the main programs page anchor
    return redirect()->to(route('programs') . '#' . $slug);
})->name('programs.show');

Route::get('/programs/item/{id}', function ($id) {
    $item = ProgramPageItem::findOrFail($id);
    abort_if(! $item->is_active, 404);

    return view('program_page_item', compact('item'));
})->name('program-page-items.show');

Route::get('/projects/{project}', function (Project $project) {
    if (! $project->is_active) {
        abort(404);
    }
    $project->load('grants');

    return view('project', compact('project'));
})->name('projects.show');

Route::get('/get-involved', function () {
    $settings = HomeSetting::allKeyed();
    $jobs = JobOpportunity::active()->ordered()->get();
    $books = Book::available()->orderBy('sort_order')->orderBy('title')->get();
    
    $partnershipCategories = \App\Models\PartnershipCategory::ordered()->get();
    $partnerPrinciples = \App\Models\PartnerPrinciple::ordered()->get();
    $worldwidePartners = \App\Models\WorldwidePartner::active()->get();

    return view('involved', compact('settings', 'jobs', 'books', 'partnershipCategories', 'partnerPrinciples', 'worldwidePartners'));
})->name('involved');

// Books for sale (public detail page)
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/jobs/{jobOpportunity}', function (JobOpportunity $jobOpportunity) {
    if (! $jobOpportunity->is_active) {
        abort(404);
    }

    return view('jobs.show', compact('jobOpportunity'));
})->name('jobs.show');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/topics', [ResourcePageController::class, 'index'])->name('resource-pages.index');
Route::get('/topics/{slug}', [ResourcePageController::class, 'show'])->name('resource-pages.show');

Route::get('/resources', function () {
    $reports = AnnualReport::active()->get();

    return view('resources', compact('reports'));
})->name('resources');

Route::get('/words-and-pictures', function () {
    return view('words-and-pictures');
})->name('words-pictures');

// Secure PDF view/download with graceful error handling
Route::get('/reports/{report}/view', function (App\Models\AnnualReport $report) {
    if (!$report->has_pdf_file) {
        return redirect()->route('resources')->with('error', 'The requested PDF file is no longer available.');
    }
    return response()->file(Storage::disk('public')->path($report->file_path));
})->name('reports.view');

Route::get('/reports/{report}/download', function (App\Models\AnnualReport $report) {
    if (!$report->has_pdf_file) {
        return redirect()->route('resources')->with('error', 'The requested PDF file is no longer available.');
    }
    return response()->download(
        Storage::disk('public')->path($report->file_path),
        $report->original_filename ?? $report->title . '.pdf'
    );
})->name('reports.download');

Route::get('/storage/{path}', function (string $path) {
    abort_if(str_contains($path, '..') || str_starts_with($path, '/') || str_starts_with($path, '\\'), 404);

    $disk = Storage::disk('public');
    abort_unless($disk->exists($path), 404);

    return response($disk->get($path), 200, [
        'Content-Type' => $disk->mimeType($path) ?: 'application/octet-stream',
    ]);
})->where('path', '.*')->name('storage.public');

Route::get('/contact', function () {
    $offices = collect(config('offices'))->map(fn ($o) => (object) $o);

    return view('contact', compact('offices'));
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/partners', function () {
    $technicalPartners = Partner::active()->where('category', PartnerCategory::Technical->value)->get();
    
    $financialPartnersBySubcategory = Partner::active()
        ->where('category', PartnerCategory::Financial->value)
        ->get()
        ->groupBy('subcategory');

    return view('partners', compact('technicalPartners', 'financialPartnersBySubcategory'));
})->name('partners');

Route::get('/donate', [DonationController::class, 'show'])->name('donate');
Route::post('/donate', [DonationController::class, 'send'])->name('donate.send');
Route::get('/donate/international', [DonationController::class, 'showInternational'])->name('donate.international');
Route::post('/donate/international', [DonationController::class, 'send'])->name('donate.international.send');
Route::post('/donation/continue', [DonationController::class, 'continueDonation']);

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Volunteer
Route::get('/volunteer', [VolunteerController::class, 'show'])->name('volunteer');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');

// Our Values detail page
Route::get('/our-values/{value}', function (CoreValue $value) {
    $settings = HomeSetting::allKeyed();
    return view('core_values.show', compact('value', 'settings'));
})->name('core-values.show');

// ──────────────────────────────────────────────
// Admin — Auth (no middleware)
// ──────────────────────────────────────────────

Route::get('/admin/login', [Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// ──────────────────────────────────────────────
// Admin — Protected Panel
// ──────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Donations
    Route::get('/donations/dashboard', [Admin\DonationDashboardController::class, 'index'])->name('donations.dashboard');
    Route::resource('donations', Admin\DonationController::class);

    // News
    Route::post('news/upload-image', [Admin\NewsController::class, 'uploadImage'])->name('news.upload-image');
    Route::resource('news', Admin\NewsController::class);

    // Words and Pictures application (public /words-and-pictures)
    Route::get('words-pictures', [Admin\WordsPicturesController::class, 'index'])->name('words-pictures.index');
    Route::post('words-pictures', [Admin\WordsPicturesController::class, 'update'])->name('words-pictures.update');

    // Topics (Resource Pages) — the categories News tags link to
    Route::resource('resource-pages', Admin\ResourcePageController::class)
        ->except(['show'])
        ->parameters(['resource-pages' => 'resourcePage']);

    // Programs & Projects
    Route::resource('programs', Admin\ProgramController::class)->except(['show']);
    Route::resource('program-pages', Admin\ProgramPageController::class)->parameters(['program-pages' => 'item']);
    Route::resource('projects', Admin\ProjectController::class)->except(['show']);

    // Project Grants (nested)
    Route::post('projects/{project}/grants', [Admin\ProjectGrantController::class, 'store'])->name('projects.grants.store');
    Route::put('projects/{project}/grants/{grant}', [Admin\ProjectGrantController::class, 'update'])->name('projects.grants.update');
    Route::delete('projects/{project}/grants/{grant}', [Admin\ProjectGrantController::class, 'destroy'])->name('projects.grants.destroy');

    // Website Settings
    Route::get('website', [Admin\WebsiteController::class, 'index'])->name('website.index');
    Route::post('website', [Admin\WebsiteController::class, 'update'])->name('website.update');

    // Homepage
    Route::get('home', [Admin\HomeSettingController::class, 'index'])->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])->name('home.update');
    Route::resource('page-sections', Admin\PageSectionController::class)->except(['show']);
    Route::resource('slides', Admin\SlideController::class)->except(['show']);
    Route::resource('impact-statistics', Admin\ImpactStatisticController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['impact-statistics' => 'impactStatistic']);

    Route::resource('sponsors', Admin\SponsorController::class)->except(['show']);
    Route::resource('gallery', Admin\GalleryController::class)->except(['show']);
    Route::resource('testimonials', Admin\TestimonialController::class)->except(['show']);

    // Map Structure
    Route::resource('map-projects', Admin\MapProjectController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['map-projects' => 'mapProject']);
    Route::post('map-projects/settings', [Admin\MapProjectController::class, 'updateSettings'])
        ->name('map-projects.settings');

    // Programs banner
    Route::get('programs-banner', [Admin\ProgramsBannerController::class, 'index'])->name('programs-banner.index');
    Route::post('programs-banner', [Admin\ProgramsBannerController::class, 'update'])->name('programs-banner.update');
    Route::get('project-defaults', [Admin\ProjectDefaultsController::class, 'index'])->name('project-defaults.index');
    Route::post('project-defaults', [Admin\ProjectDefaultsController::class, 'update'])->name('project-defaults.update');
    Route::post('project-defaults/{project}', [Admin\ProjectDefaultsController::class, 'updateProject'])->name('project-defaults.project.update');

    // Who We Are
    Route::get('presentation', [Admin\PresentationController::class, 'index'])->name('presentation.index');
    Route::post('presentation', [Admin\PresentationController::class, 'update'])->name('presentation.update');
    Route::resource('presentation-slides', Admin\PresentationSlideController::class)->except(['show'])->parameters(['presentation-slides' => 'slide']);
    Route::resource('principle-slides', Admin\PrincipleSlideController::class)->except(['show'])->parameters(['principle-slides' => 'slide']);
    Route::resource('partners', Admin\PartnerController::class)->except(['show']);
    Route::resource('awards', Admin\AwardController::class)->except(['show', 'create']);
    Route::get('history-banner', [Admin\HistoryBannerController::class, 'index'])->name('history-banner.index');
    Route::post('history-banner', [Admin\HistoryBannerController::class, 'update'])->name('history-banner.update');
    Route::resource('history-events', Admin\HistoryEventController::class)
        ->except(['show', 'create'])
        ->parameters(['history-events' => 'historyEvent']);
    Route::resource('core-values', Admin\CoreValueController::class)
        ->except(['show', 'edit'])
        ->parameters(['core-values' => 'coreValue']);

    // Worldwide Partners
    Route::resource('worldwide-partners', Admin\WorldwidePartnerController::class)
        ->parameters(['worldwide-partners' => 'worldwidePartner']);

    Route::post('transparency-content', [Admin\TransparencyController::class, 'updateContent'])->name('transparency.content.update');
    Route::post('transparency-banner', [Admin\TransparencyController::class, 'updateBanner'])->name('transparency.banner.update');
    Route::resource('transparency', Admin\TransparencyController::class)
        ->except(['show'])
        ->parameters(['transparency' => 'report']);

    // Reports — Activity Logs (must be before reports resource to avoid route collision)
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('activity-logs', [Admin\Reports\ActivityLogController::class, 'index'])
            ->name('activity-logs.index');
        Route::get('activity-logs/{activityLog}', [Admin\Reports\ActivityLogController::class, 'show'])
            ->name('activity-logs.show');
    });

    // Reports
    Route::resource('reports', Admin\AnnualReportController::class);

    // Books for Sale
    Route::resource('books', Admin\BookController::class)->except(['show']);

    // Payment Methods
    Route::resource('payments', Admin\PaymentMethodController::class)->except(['show']);

    // Get Involved
    Route::resource('jobs', Admin\JobOpportunityController::class)->except(['show', 'create', 'edit']);

    // Donation Campaigns
    Route::resource('campaigns', Admin\CampaignController::class)->except(['show']);
    Route::patch('campaigns/{campaign}/toggle', [Admin\CampaignController::class, 'toggle'])->name('campaigns.toggle');

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [Admin\ContactInquiryController::class, 'index'])->name('index');
        Route::get('{contactInquiry}', [Admin\ContactInquiryController::class, 'show'])->name('show');
        Route::patch('{contactInquiry}/status', [Admin\ContactInquiryController::class, 'updateStatus'])->name('status');
        Route::delete('{contactInquiry}', [Admin\ContactInquiryController::class, 'destroy'])->name('destroy');
    });

    // Newsletter Subscribers
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/', [Admin\NewsletterController::class, 'index'])->name('index');
        Route::get('export', [Admin\NewsletterController::class, 'export'])->name('export');
        Route::delete('{newsletterSubscriber}', [Admin\NewsletterController::class, 'destroy'])->name('destroy');
    });

    // Volunteer Applications
    Route::prefix('volunteers')->name('volunteers.')->group(function () {
        Route::get('/', [Admin\VolunteerController::class, 'index'])->name('index');
        Route::get('{volunteer}', [Admin\VolunteerController::class, 'show'])->name('show');
        Route::patch('{volunteer}/status', [Admin\VolunteerController::class, 'updateStatus'])->name('status');
        Route::delete('{volunteer}', [Admin\VolunteerController::class, 'destroy'])->name('destroy');
    });


});
