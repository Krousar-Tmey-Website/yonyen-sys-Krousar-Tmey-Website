<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Partner;
use App\Models\Award;
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

    return view('home', compact('settings', 'latestNews', 'slides', 'programs'));
})->name('home');

Route::get('/who-we-are', function () {
    $partners = Partner::active()->get()->groupBy('category');
    $awards   = Award::ordered()->get();
    return view('about', compact('partners', 'awards'));
})->name('about');

Route::get('/our-programs', fn() => view('programs'))->name('programs');

Route::get('/get-involved', fn() => view('involved'))->name('involved');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/resources', fn() => view('resources'))->name('resources');
Route::get('/contact',   fn() => view('contact'))->name('contact');

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
        ->only(['index', 'edit', 'update']);

    Route::get('home', [Admin\HomeSettingController::class, 'index'])
        ->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])
        ->name('home.update');

    Route::resource('partners', Admin\PartnerController::class)->except(['show', 'create']);
    Route::resource('awards',   Admin\AwardController::class)->except(['show', 'create', 'edit']);
    Route::resource('slides',   Admin\SlideController::class)->except(['show']);
    Route::resource('users',    Admin\UserController::class)->except(['show']);
    // Partner Management
});
