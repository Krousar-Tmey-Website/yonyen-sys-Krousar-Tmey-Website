<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VolunteerController;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Partner;
use App\Models\PartnerCategory;
use App\Models\Award;
use App\Models\PageSection;
use App\Models\Program;
use App\Models\Slide;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

// ──────────────────────────────────────────────
// Public pages
// ──────────────────────────────────────────────

Route::get('/', function () {
    $settings   = HomeSetting::allKeyed();
    $latestNews = News::published()->latest('published_at')->take(3)->get();
    $slides     = Slide::active()->get();

    // Homepage programs are static: only the two main program cards should appear.
    $programs = Program::whereIn('slug', ['child-welfare', 'special-education'])
        ->where('is_active', true)
        ->orderByRaw("FIELD(slug, 'child-welfare','special-education')")
        ->get();

    $pageSections = PageSection::with(['images', 'links'])
        ->where('active', true)
        ->orderBy('order')
        ->get();

    return view('home', compact('settings', 'latestNews', 'slides', 'programs', 'pageSections'));
})->name('home');

Route::get('/who-we-are', function () {
    $partnerCategories = PartnerCategory::with(['partners' => function ($query) {
        $query->active();
    }])->orderBy('name')->get();
    $awards   = Award::ordered()->get();
    return view('about', compact('partnerCategories', 'awards'));
})->name('about');

Route::get('/our-programs', function () {
    $programs = Program::active()->get();
    return view('programs', compact('programs'));
})->name('programs');

Route::get('/get-involved', fn() => view('involved'))->name('involved');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/resources', fn() => view('resources'))->name('resources');
Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/volunteer',  [VolunteerController::class, 'show'])->name('volunteer');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');

Route::get('/partners', function () {
    $partners = Partner::active()
        ->where('category', 'organizations')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();
    return view('partners', compact('partners'));
})->name('partners');

Route::get('/donate',  [DonationController::class, 'show'])->name('donate');
Route::post('/donate', [DonationController::class, 'send'])->name('donate.send');

// ──────────────────────────────────────────────
// Admin — Auth (no middleware)
// ──────────────────────────────────────────────

Route::get('/admin/login',   [Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login',  [Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// ──────────────────────────────────────────────
// Admin — Protected panel
// ──────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('news', Admin\NewsController::class);
    Route::resource('programs', Admin\ProgramController::class)
        ->except(['create', 'store', 'destroy']);

    Route::get('home', [Admin\HomeSettingController::class, 'index'])
        ->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])
        ->name('home.update');

    Route::resource('partners', Admin\PartnerController::class)->except(['show', 'create']);
    Route::resource('awards',   Admin\AwardController::class)->except(['show', 'create', 'edit']);
    Route::resource('slides',   Admin\SlideController::class)->except(['show']);
    Route::resource('users',    Admin\UserController::class)->except(['show']);
    Route::resource('page-sections', Admin\PageSectionController::class)
        ->except(['show']);
    // Partner Management

    Route::get('website', [Admin\WebsiteController::class, 'index'])
        ->name('website.index');
    Route::post('website', [Admin\WebsiteController::class, 'update'])
        ->name('website.update');

    Route::prefix('volunteers')->name('volunteers.')->group(function () {
        Route::get('/',           [Admin\VolunteerController::class, 'index'])->name('index');
        Route::get('{volunteer}', [Admin\VolunteerController::class, 'show'])->name('show');
        Route::patch('{volunteer}/status', [Admin\VolunteerController::class, 'updateStatus'])->name('status');
        Route::delete('{volunteer}',       [Admin\VolunteerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/',                      [Admin\ContactInquiryController::class, 'index'])->name('index');
        Route::get('{contactInquiry}',       [Admin\ContactInquiryController::class, 'show'])->name('show');
        Route::patch('{contactInquiry}/status', [Admin\ContactInquiryController::class, 'updateStatus'])->name('status');
        Route::delete('{contactInquiry}',       [Admin\ContactInquiryController::class, 'destroy'])->name('destroy');
    });
    // Categories
    Route::resource('categories', CategoryController::class);

    // Partner Management
    Route::resource('partners', Admin\PartnerController::class);

    Route::resource('awards', Admin\AwardController::class)
        ->except(['create', 'edit']);

    Route::resource('slides', Admin\SlideController::class);
});
