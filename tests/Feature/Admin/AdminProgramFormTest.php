<?php

namespace Tests\Feature\Admin;

use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\HtmlString;
use Tests\TestCase;

class AdminProgramFormTest extends TestCase
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

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('full_description')->nullable();
            $table->text('full_description_fr')->nullable();
            $table->string('image')->nullable();
            $table->string('icon_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('Status')->nullable();
            $table->string('Status_fr')->nullable();
            $table->string('testimony_name')->nullable();
            $table->string('testimony_name_fr')->nullable();
            $table->text('testimony_story')->nullable();
            $table->text('testimony_story_fr')->nullable();
            $table->string('testimony_image')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('programs');
        Schema::dropIfExists('users');

        parent::tearDown();
    }

    public function test_program_create_and_edit_pages_render_top_level_language_toggle(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $program = Program::create([
            'title' => 'Education',
            'title_fr' => 'Education FR',
            'slug' => 'education',
            'description' => 'English objective',
            'description_fr' => 'Objectif francais',
            'full_description' => 'English program text',
            'full_description_fr' => 'Texte francais',
            'image' => 'https://example.com/program.jpg',
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.programs.create'))
            ->assertOk()
            ->assertSee('Toggle editing language (English / French)')
            ->assertSee('x-text="previewTitle"', false);

        $this->actingAs($admin)
            ->get(route('admin.programs.edit', $program))
            ->assertOk()
            ->assertSee('Toggle editing language (English / French)')
            ->assertSee('x-text="previewTitle"', false);
    }

    public function test_program_admin_persists_french_fields_through_real_controller_flow(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('admin.programs.store'), [
                'title' => 'Child Welfare',
                'title_fr' => 'Protection de lenfance',
                'description' => 'English objective',
                'description_fr' => 'Objectif en francais',
                'full_description' => 'English program text',
                'full_description_fr' => 'Texte du programme en francais',
                'image_url' => 'https://example.com/program.jpg',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.programs.index'));

        $program = Program::query()->firstOrFail();

        $this->assertSame('Protection de lenfance', $program->title_fr);
        $this->assertSame('Objectif en francais', $program->description_fr);
        $this->assertSame('Texte du programme en francais', $program->full_description_fr);

        $this->actingAs($admin)
            ->put(route('admin.programs.update', $program), [
                'title' => 'Child Welfare Updated',
                'title_fr' => 'Protection de lenfance mise a jour',
                'description' => 'English objective updated',
                'description_fr' => 'Objectif francais mis a jour',
                'full_description' => 'English program text updated',
                'full_description_fr' => 'Texte francais mis a jour',
                'image_url' => 'https://example.com/program-updated.jpg',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.programs.index'));

        $program->refresh();

        $this->assertSame('Child Welfare Updated', $program->title);
        $this->assertSame('Protection de lenfance mise a jour', $program->title_fr);
        $this->assertSame('Objectif francais mis a jour', $program->description_fr);
        $this->assertSame('Texte francais mis a jour', $program->full_description_fr);
        $this->assertSame('https://example.com/program-updated.jpg', $program->image);
    }
}
