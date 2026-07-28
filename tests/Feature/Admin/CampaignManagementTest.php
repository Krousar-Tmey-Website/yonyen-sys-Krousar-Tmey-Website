<?php

namespace Tests\Feature\Admin;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Vite;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Tests\TestCase;

class CampaignManagementTest extends TestCase
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

        // The public layout renders a Programs dropdown and footer list.
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('year', 20)->nullable();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->text('description')->nullable();
            $table->text('description_fr')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('home_settings');
        Schema::dropIfExists('users');

        parent::tearDown();
    }

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function campaign(array $overrides = []): Campaign
    {
        return Campaign::create(array_merge([
            'title'       => 'Back to School',
            'title_fr'    => 'La rentrée scolaire',
            'year'        => '2026',
            'description' => '<p>Help 500 children return to class.</p>',
            'is_active'   => true,
        ], $overrides));
    }

    public function test_create_form_exposes_both_language_sections(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.campaigns.create'))
            ->assertOk()
            ->assertSee('Toggle editing language (English / French)')
            ->assertSee('name="title"', false)
            ->assertSee('name="title_fr"', false)
            ->assertSee('name="description"', false)
            ->assertSee('name="description_fr"', false)
            ->assertSee('name="year"', false);
    }

    public function test_index_lists_campaigns_and_exposes_the_banner_form(): void
    {
        $this->campaign();
        $this->campaign(['title' => 'Hidden Drive', 'is_active' => false]);

        $this->actingAs($this->admin())
            ->get(route('admin.campaigns.index'))
            ->assertOk()
            ->assertSee('Back to School')
            // Drafts stay visible to admins, unlike on the public page.
            ->assertSee('Hidden Drive')
            ->assertSee('Published')
            ->assertSee('Draft')
            ->assertSee('name="campaigns_banner_title"', false)
            ->assertSee(route('admin.campaigns.create'), false);
    }

    public function test_edit_form_is_prefilled_in_both_languages(): void
    {
        $campaign = $this->campaign();

        $this->actingAs($this->admin())
            ->get(route('admin.campaigns.edit', $campaign))
            ->assertOk()
            ->assertSee('value="Back to School"', false)
            ->assertSee('value="La rentrée scolaire"', false)
            ->assertSee('value="2026"', false)
            ->assertSee('Help 500 children return to class.', false)
            ->assertSee('Delete Campaign');
    }

    public function test_admin_can_create_a_campaign_with_media(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post(route('admin.campaigns.store'), [
                'title'          => 'Back to School',
                'title_fr'       => 'La rentrée scolaire',
                'year'           => '2026',
                'description'    => '<p>Help 500 children return to class.</p>',
                'description_fr' => '<p>Aidez 500 enfants à retourner en classe.</p>',
                // ->image() needs the GD extension; an explicit mime keeps this portable.
                'image'          => UploadedFile::fake()->create('cover.jpg', 80, 'image/jpeg'),
                'file'           => UploadedFile::fake()->create('brief.pdf', 120, 'application/pdf'),
                'video_url'      => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_active'      => 1,
            ])
            ->assertRedirect(route('admin.campaigns.index'));

        $campaign = Campaign::firstOrFail();

        $this->assertSame('back-to-school', $campaign->slug);
        $this->assertSame('2026', $campaign->year);
        $this->assertSame('La rentrée scolaire', $campaign->title_fr);
        $this->assertSame('brief.pdf', $campaign->file_original_name);
        $this->assertSame('https://www.youtube.com/embed/dQw4w9WgXcQ', $campaign->video_embed_url);

        Storage::disk('public')->assertExists($campaign->image);
        Storage::disk('public')->assertExists($campaign->file);
    }

    public function test_update_without_new_uploads_keeps_existing_media(): void
    {
        $campaign = $this->campaign([
            'image' => 'campaigns/existing.jpg',
            'video' => 'https://vimeo.com/12345',
            'file'  => 'campaigns/files/existing.pdf',
            'file_original_name' => 'existing.pdf',
        ]);

        $this->actingAs($this->admin())
            ->put(route('admin.campaigns.update', $campaign), [
                'title'     => 'Back to School 2027',
                'year'      => '2027',
                'is_active' => 1,
            ])
            ->assertRedirect(route('admin.campaigns.index'));

        $campaign->refresh();

        $this->assertSame('2027', $campaign->year);
        $this->assertSame('back-to-school-2027', $campaign->slug);
        $this->assertSame('campaigns/existing.jpg', $campaign->image);
        $this->assertSame('https://vimeo.com/12345', $campaign->video);
        $this->assertSame('campaigns/files/existing.pdf', $campaign->file);
    }

    public function test_admin_can_remove_media_and_unpublish(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('campaigns/existing.jpg', 'x');

        $campaign = $this->campaign(['image' => 'campaigns/existing.jpg']);

        $this->actingAs($this->admin())
            ->put(route('admin.campaigns.update', $campaign), [
                'title'        => 'Back to School',
                'year'         => '2026',
                'remove_image' => 1,
            ])
            ->assertRedirect(route('admin.campaigns.index'));

        $campaign->refresh();

        $this->assertNull($campaign->image);
        $this->assertFalse($campaign->is_active);
        Storage::disk('public')->assertMissing('campaigns/existing.jpg');
    }

    public function test_admin_can_delete_a_campaign(): void
    {
        $campaign = $this->campaign();

        $this->actingAs($this->admin())
            ->delete(route('admin.campaigns.destroy', $campaign))
            ->assertRedirect(route('admin.campaigns.index'));

        $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    }

    public function test_year_and_title_are_required(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.campaigns.store'), ['title' => '', 'year' => ''])
            ->assertSessionHasErrors(['title', 'year']);
    }

    public function test_guests_cannot_reach_the_admin_campaign_screens(): void
    {
        $this->get(route('admin.campaigns.index'))->assertRedirect(route('admin.login'));
        $this->post(route('admin.campaigns.store'), [])->assertRedirect(route('admin.login'));
    }

    public function test_public_index_lists_active_campaigns_with_both_actions(): void
    {
        $this->campaign();
        $this->campaign(['title' => 'Hidden Drive', 'is_active' => false]);

        $this->get(route('campaigns.index'))
            ->assertOk()
            ->assertSee('Back to School')
            ->assertDontSee('Hidden Drive')
            ->assertSee('2026')
            ->assertSee('Read More')
            ->assertSee(route('donate'), false);
    }

    public function test_public_detail_shows_content_and_hides_inactive(): void
    {
        $campaign = $this->campaign();
        $this->campaign(['title' => 'Second Campaign']);
        $hidden = $this->campaign(['title' => 'Hidden Drive', 'is_active' => false]);

        $this->get(route('campaigns.show', $campaign))
            ->assertOk()
            ->assertSee('Back to School')
            ->assertSee('Help 500 children return to class.', false)
            ->assertSee('2026')
            ->assertSee(route('donate'), false)
            // "More campaigns" strip picks up the other active campaign.
            ->assertSee('Second Campaign');

        $this->get(route('campaigns.show', $hidden))->assertNotFound();
    }

    public function test_french_locale_prefers_french_fields(): void
    {
        $campaign = $this->campaign([
            'description_fr' => '<p>Aidez 500 enfants à retourner en classe.</p>',
        ]);

        $this->withSession(['locale' => 'fr'])
            ->get(route('campaigns.show', $campaign))
            ->assertOk()
            ->assertSee('La rentrée scolaire')
            ->assertSee('Aidez 500 enfants', false);
    }
}
