<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Partner;
use App\Models\Award;
use App\Models\Slide;
use App\Models\HistoryEvent;
use App\Models\AnnualReport;
use App\Models\Office;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\HistoryController;

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
    $history  = HistoryEvent::ordered()->get();
    return view('about', compact('partners', 'awards', 'history'));
})->name('about');

Route::get('/our-programs', fn() => view('programs'))->name('programs');

Route::get('/get-involved', fn() => view('involved'))->name('involved');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/awards', fn() => view('awards', ['awards' => Award::ordered()->get()]))->name('awards');
Route::get('/resources', function () {
    $reports = AnnualReport::active()->get();
    return view('resources', compact('reports'));
})->name('resources');

Route::get('/contact', function () {
    $offices = Office::active()->get();
    return view('contact', compact('offices'));
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/partners', fn () => redirect()->route('about'))->name('partners');

Route::get('/donate',  [DonationController::class, 'show'])->name('donate');
Route::post('/donate', [DonationController::class, 'send'])->name('donate.send');

// Newsletter subscription
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

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
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // News - use resource with explicit names
    Route::resource('news', Admin\NewsController::class);

    // Categories - use resource with explicit names
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Programs
    Route::resource('programs', Admin\ProgramController::class)->only(['index', 'edit', 'update']);

    // Home Settings
    Route::get('home',  [Admin\HomeSettingController::class, 'index'])->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])->name('home.update');

    // Partners, Awards, Slides
    Route::resource('partners', Admin\PartnerController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards',   Admin\AwardController::class)->except(['show']);
    Route::get('awards/{award}', [Admin\AwardController::class, 'show'])->name('awards.show');
    Route::resource('slides',   Admin\SlideController::class)->except(['show']);

    // History
    Route::resource('history', HistoryController::class)->except(['show']);
});