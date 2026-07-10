<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Models\AnnualReport;
use App\Models\Award;
use App\Models\CoreValue;
use App\Models\Gallery;
use App\Models\HistoryEvent;
use App\Models\HomeSetting;
use App\Models\News;
use App\Models\Office;
use App\Models\PageSection;
use App\Models\Partner;
use App\Models\Program;
use App\Models\Project;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// ──────────────────────────────────────────────
// Public Routes
// ──────────────────────────────────────────────

Route::get('/', function () {
    $settings     = HomeSetting::allKeyed();
    $latestNews   = News::published()->latest('published_at')->take(3)->get();
    $slides       = Slide::active()->get();
    $projects     = Project::where('is_active', true)->take(3)->get();
    $testimonials = Testimonial::where('is_active', true)->take(3)->get();
    $galleries    = Gallery::where('is_active', true)->latest()->take(6)->get();
    $programs     = Program::active()->take(3)->get();
    $pageSections = PageSection::where('active', true)->with(['images', 'links'])->orderBy('order')->get();
    return view('home', compact('settings', 'latestNews', 'slides', 'projects', 'testimonials', 'galleries', 'programs', 'pageSections'));
})->name('home');

Route::get('/who-we-are', function () {
    $categoryMap = [1 => 'authorities', 2 => 'organizations', 3 => 'companies', 4 => 'towns'];
    $partners    = Partner::active()->get()->groupBy(function ($p) use ($categoryMap) {
        return $categoryMap[$p->category_id] ?? 'other';
    });
    $awards        = Award::ordered()->get();
    $offices       = Office::active()->get();
    $historyEvents = HistoryEvent::active()->get();
    $reports       = AnnualReport::active()->get();
    $settings      = HomeSetting::allKeyed();
    $coreValues    = CoreValue::ordered()->get();
    return view('about', compact('partners', 'awards', 'offices', 'historyEvents', 'reports', 'settings', 'coreValues'));
})->name('about');

Route::get('/our-programs', function () {
    $programs       = Program::active()->with(['projects' => function ($q) { $q->where('is_active', true)->orderBy('id'); }])->get();
    $bannerTitle    = HomeSetting::getValue('programs_banner_title',    'Our Programs');
    $bannerSubtitle = HomeSetting::getValue('programs_banner_subtitle', 'Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.');
    $bannerImage    = HomeSetting::getValue('programs_banner_image',    '');
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
    if (!$project->is_active) abort(404);
    $project->load('grants');
    return view('project', compact('project'));
})->name('projects.show');

Route::get('/get-involved', function () {
    $settings = HomeSetting::allKeyed();
    return view('involved', compact('settings'));
})->name('involved');

Route::get('/news',        [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/resources', function () {
    $reports = AnnualReport::active()->get();
    return view('resources', compact('reports'));
})->name('resources');

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

Route::get('/contact',  [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/partners', fn () => redirect()->route('about'))->name('partners');

Route::get('/donate',  [DonationController::class, 'show'])->name('donate');
Route::post('/donate', [DonationController::class, 'send'])->name('donate.send');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// ──────────────────────────────────────────────
// Admin — Auth (no middleware)
// ──────────────────────────────────────────────

Route::get('/admin/login',   [Admin\AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login',  [Admin\AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

// ──────────────────────────────────────────────
// Admin — Protected Panel
// ──────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // News & Categories
    Route::resource('news',       Admin\NewsController::class);
    Route::resource('categories', Admin\CategoryController::class)->except(['show']);

    // Programs & Projects
    Route::resource('programs',      Admin\ProgramController::class)->except(['show']);
    Route::resource('program-pages', Admin\ProgramPageController::class)->parameters(['program-pages' => 'item']);
    Route::resource('projects',      Admin\ProjectController::class)->except(['show']);

    // Project Grants (nested under projects)
    Route::post('projects/{project}/grants',         [Admin\ProjectGrantController::class, 'store'])->name('projects.grants.store');
    Route::put('projects/{project}/grants/{grant}',   [Admin\ProjectGrantController::class, 'update'])->name('projects.grants.update');
    Route::delete('projects/{project}/grants/{grant}', [Admin\ProjectGrantController::class, 'destroy'])->name('projects.grants.destroy');

    // Homepage Settings
    Route::get('home',  [Admin\HomeSettingController::class, 'index'])->name('home.index');
    Route::post('home', [Admin\HomeSettingController::class, 'update'])->name('home.update');
    Route::resource('page-sections', Admin\PageSectionController::class)->except(['show']);
    Route::resource('slides',        Admin\SlideController::class)->except(['show']);

    // Programs Banner
    Route::get('programs-banner',  [Admin\ProgramsBannerController::class, 'index'])->name('programs-banner.index');
    Route::post('programs-banner', [Admin\ProgramsBannerController::class, 'update'])->name('programs-banner.update');

    // Who We Are
    Route::resource('partners',       Admin\PartnerController::class)->except(['show', 'create']);
    Route::resource('awards',         Admin\AwardController::class)->except(['show', 'create', 'edit']);
    Route::resource('history-events', Admin\HistoryEventController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['history-events' => 'historyEvent']);
    Route::resource('core-values', Admin\CoreValueController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['core-values' => 'coreValue']);

    // Reports
    Route::resource('reports', Admin\AnnualReportController::class);

    // Users
    Route::resource('users', Admin\UserController::class)->except(['show']);

    // Contacts (Inquiries)
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/',                            [Admin\ContactInquiryController::class, 'index'])->name('index');
        Route::get('{contactInquiry}',             [Admin\ContactInquiryController::class, 'show'])->name('show');
        Route::patch('{contactInquiry}/status',    [Admin\ContactInquiryController::class, 'updateStatus'])->name('status');
        Route::delete('{contactInquiry}',          [Admin\ContactInquiryController::class, 'destroy'])->name('destroy');
    });

    // Newsletter Subscribers
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/',                           [Admin\NewsletterController::class, 'index'])->name('index');
        Route::get('export',                      [Admin\NewsletterController::class, 'export'])->name('export');
        Route::delete('{newsletterSubscriber}',   [Admin\NewsletterController::class, 'destroy'])->name('destroy');
    });
});
