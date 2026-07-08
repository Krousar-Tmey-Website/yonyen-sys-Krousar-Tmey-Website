<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DonationController;
use App\Models\Award;
use App\Models\Gallery;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Project;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────
// Public pages
// ──────────────────────────────────────────────

Route::get('/', function () {
    $settings     = HomeSetting::allKeyed();
    $latestNews   = News::published()->latest('published_at')->take(3)->get();
    $slides       = Slide::active()->get();
    $projects     = Project::where('is_active', true)->take(3)->get();
    $testimonials = Testimonial::where('is_active', true)->take(3)->get();
    $galleries    = Gallery::where('is_active', true)->latest()->take(6)->get();
    $programs     = Program::active()->take(3)->get();
    return view('home', compact('settings', 'latestNews', 'slides', 'projects', 'testimonials', 'galleries', 'programs'));
})->name('home');

Route::get('/who-we-are', function () {
    $partners = Partner::active()->get()->groupBy('category');
    $awards   = Award::ordered()->get();
    return view('about', compact('partners', 'awards'));
})->name('about');

Route::get('/our-programs', function () {
    $programs       = Program::active()->with(['projects' => function($q){ $q->where('is_active', true)->orderBy('id'); }])->get();
    $bannerTitle    = HomeSetting::getValue('programs_banner_title',   'Our Programs');
    $bannerSubtitle = HomeSetting::getValue('programs_banner_subtitle', 'Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.');
    $bannerImage    = HomeSetting::getValue('programs_banner_image',   '');
    return view('programs', compact('programs', 'bannerTitle', 'bannerSubtitle', 'bannerImage'));
})->name('programs');

Route::get('/our-programs/{slug}', function ($slug) {
    $program = Program::where('slug', $slug)->firstOrFail();
    return redirect()->route('programs', ['#' . $program->slug]);
})->name('programs.show');

Route::get('/programs/item/{id}', function ($id) {
    $item = App\Models\ProgramPageItem::findOrFail($id);
    abort_if(!$item->is_active, 404);
    return view('program_page_item', compact('item'));
})->name('program-page-items.show');

Route::get('/projects/{project}', function (Project $project) {
    if (!$project->is_active) return abort(404);
    return view('project', compact('project'));
})->name('projects.show');

Route::get('/get-involved', fn() => view('involved'))->name('involved');

Route::get('/news', function () {
    $articles = News::published()->latest('published_at')->get();
    return view('news', compact('articles'));
})->name('news');

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
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('news',     Admin\NewsController::class);
    Route::resource('programs', Admin\ProgramController::class)->except(['show']);
    Route::resource('program-pages', Admin\ProgramPageController::class)->parameters(['program-pages' => 'item']);
    
    Route::resource('projects', Admin\ProjectController::class)->except(['show']);
    Route::resource('gallery', Admin\GalleryController::class)->except(['show']);
    Route::resource('testimonials', Admin\TestimonialController::class)->except(['show']);

    Route::get('home',  [Admin\HomeSettingController::class, 'index'])->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])->name('home.update');

    Route::get('programs-banner',  [Admin\ProgramsBannerController::class, 'index'])->name('programs-banner.index');
    Route::post('programs-banner', [Admin\ProgramsBannerController::class, 'update'])->name('programs-banner.update');

    Route::resource('partners', Admin\PartnerController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards',   Admin\AwardController::class)->except(['show', 'create', 'edit']);
    Route::resource('slides',   Admin\SlideController::class)->except(['show']);
});
