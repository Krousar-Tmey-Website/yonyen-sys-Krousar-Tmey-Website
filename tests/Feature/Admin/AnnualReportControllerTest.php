<?php

namespace Tests\Feature\Admin;

use App\Models\AnnualReport;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AnnualReportControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('annual_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('year');
            $table->string('file_path')->nullable();
            $table->string('original_filename')->nullable();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('annual_reports');
        Schema::dropIfExists('users');

        parent::tearDown();
    }

    public function test_admin_can_manage_annual_reports(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.reports.index'));
        $response->assertOk();

        $file = UploadedFile::fake()->create('annual-report-2024.pdf', 100, 'application/pdf');

        $response = $this->post(route('admin.reports.store'), [
            'title' => 'Annual Report 2024',
            'year' => 2024,
            'file' => $file,
        ]);
        $response->assertRedirect(route('admin.reports.index'));
        $this->assertDatabaseHas('annual_reports', ['title' => 'Annual Report 2024', 'year' => 2024]);

        $report = AnnualReport::latest()->first();

        $response = $this->get(route('admin.reports.show', $report));
        $response->assertOk();
        $response->assertSee('Annual Report 2024');

        $response = $this->get(route('resources'));
        $response->assertOk();
        $response->assertSee('Annual Report 2024');

        $response = $this->get(route('admin.reports.index', ['search' => '2024']));
        $response->assertOk();
        $response->assertSee('Annual Report 2024');
        $response->assertSee('View report');
        $response->assertDontSeeText('View PDF');
        $response->assertDontSeeText('Download PDF');

        $updatedFile = UploadedFile::fake()->create('updated-2024.pdf', 120, 'application/pdf');

        $response = $this->put(route('admin.reports.update', $report), [
            'title' => 'Annual Report 2024 Updated',
            'year' => 2025,
            'file' => $updatedFile,
        ]);
        $response->assertRedirect(route('admin.reports.index'));
        $this->assertDatabaseHas('annual_reports', ['title' => 'Annual Report 2024 Updated', 'year' => 2025]);

        Storage::disk('public')->delete($report->file_path);

        $response = $this->get(route('admin.reports.show', $report));
        $response->assertOk();
        $response->assertSee('No PDF file available.');
        $response->assertSee('cursor-not-allowed', false);

        $response = $this->delete(route('admin.reports.destroy', $report));
        $response->assertRedirect(route('admin.reports.index'));
        $this->assertDatabaseMissing('annual_reports', ['id' => $report->id]);
    }
}
