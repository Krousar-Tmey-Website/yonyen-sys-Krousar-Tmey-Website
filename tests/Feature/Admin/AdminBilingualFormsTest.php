<?php

namespace Tests\Feature\Admin;

use App\Models\MapProject;
use App\Models\PrincipleSlide;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\HtmlString;
use Tests\TestCase;

class AdminBilingualFormsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(Vite::class, new class {
            public function __invoke(): HtmlString
            {
                return new HtmlString('');
            }
        });

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

        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('label')->nullable();
            $table->string('group')->nullable();
            $table->timestamps();
        });

        Schema::create('map_projects', function (Blueprint $table) {
            $table->id();
            $table->string('province_key');
            $table->string('province_label')->nullable();
            $table->string('location_name');
            $table->string('location_name_fr')->nullable();
            $table->string('project_type');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('principle_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_fr')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('principle_slides');
        Schema::dropIfExists('map_projects');
        Schema::dropIfExists('home_settings');
        Schema::dropIfExists('users');

        parent::tearDown();
    }

    public function test_map_project_admin_supports_bilingual_location_fields(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get(route('admin.map-projects.index'))
            ->assertOk()
            ->assertSee('Toggle editing language (English / French)')
            ->assertSee('name="location_name"', false)
            ->assertSee('name="location_name_fr"', false);

        $this->actingAs($admin)
            ->post(route('admin.map-projects.store'), [
                'province_key' => 'phnom-penh',
                'province_label' => 'Phnom Penh',
                'location_name' => 'Central Hub',
                'location_name_fr' => 'Centre Principal',
                'project_type' => 'Child Welfare',
                'sort_order' => 3,
            ])
            ->assertRedirect(route('admin.map-projects.index'));

        $project = MapProject::query()->firstOrFail();

        $this->assertSame('Central Hub', $project->location_name);
        $this->assertSame('Centre Principal', $project->location_name_fr);
    }

    public function test_principle_slide_admin_supports_bilingual_inline_editing(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $slide = PrincipleSlide::create([
            'title' => 'Community Support',
            'title_fr' => 'Soutien communautaire',
            'image' => 'https://example.com/slide.jpg',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.principle-slides.index'))
            ->assertOk()
            ->assertSee('Toggle editing language (English / French)')
            ->assertSee('name="title_fr"', false);

        $this->actingAs($admin)
            ->put(route('admin.principle-slides.update', $slide), [
                'title' => 'Community Support Updated',
                'title_fr' => 'Soutien communautaire mis a jour',
                'image_url' => 'https://example.com/slide.jpg',
                'sort_order' => 2,
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.principle-slides.index'));

        $slide->refresh();

        $this->assertSame('Community Support Updated', $slide->title);
        $this->assertSame('Soutien communautaire mis a jour', $slide->title_fr);
        $this->assertSame(2, $slide->sort_order);
        $this->assertTrue($slide->is_active);
        $this->assertSame(1, PrincipleSlide::count());
    }
}
