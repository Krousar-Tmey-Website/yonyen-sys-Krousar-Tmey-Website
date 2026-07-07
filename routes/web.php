<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Partner;
use App\Models\Award;
use App\Models\Slide;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────
// Public pages
// ──────────────────────────────────────────────

Route::get('/', function () {
    $settings   = HomeSetting::allKeyed();
    $latestNews = News::published()->latest('published_at')->take(3)->get();
    $slides     = Slide::active()->get();
    return view('home', compact('settings', 'latestNews', 'slides'));
})->name('home');

Route::get('/who-we-are', function () {
    $partners = Partner::active()->get()->groupBy('category');
    $awards   = Award::ordered()->get();
    return view('about', compact('partners', 'awards'));
})->name('about');

Route::get('/our-programs', fn() => view('programs'))->name('programs');

Route::get('/get-involved', fn() => view('involved'))->name('involved');

Route::get('/news', function () {
    $articles = News::published()->latest('published_at')->get();
    return view('news', compact('articles'));
})->name('news');

Route::get('/resources', fn() => view('resources'))->name('resources');
Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/volunteer',  [VolunteerController::class, 'show'])->name('volunteer');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');

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
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('news',     Admin\NewsController::class);
    Route::resource('programs', Admin\ProgramController::class)->only(['index', 'edit', 'update']);

    Route::get('home',  [Admin\HomeSettingController::class, 'index'])->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])->name('home.update');

    Route::resource('partners', Admin\PartnerController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards',   Admin\AwardController::class)->except(['show', 'create', 'edit']);
    Route::resource('slides',   Admin\SlideController::class)->except(['show']);

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
});
