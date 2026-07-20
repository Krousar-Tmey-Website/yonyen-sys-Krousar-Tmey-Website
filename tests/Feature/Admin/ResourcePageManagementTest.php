<?php

namespace Tests\Feature\Admin;

use App\Models\News;
use App\Models\ResourcePage;
use App\Models\User;
use Illuminate\Foundation\Vite;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Tests\TestCase;

class ResourcePageManagementTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

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
            $table->boolean('is_admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('videos')->nullable();
            $table->string('category')->default('general');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->json('links')->nullable();
            $table->json('tag_links')->nullable();
            $table->timestamps();
        });

        Schema::create('resource_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('header_text')->nullable();
            $table->string('detail_image')->nullable();
            $table->text('detail_description')->nullable();
            $table->json('items')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function test_admin_can_create_a_topic_with_images_and_feature_items(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.resource-pages.store'), [
            'title' => 'Cambodia',
            'description' => 'Our work across Cambodia.',
            'sort_order' => '5',
            'is_active' => '1',
            'image' => UploadedFile::fake()->create('cambodia.jpg', 10, 'image/jpeg'),
            'items' => [
                0 => ['title' => 'Schools built', 'description' => '12 schools and counting'],
            ],
        ]);

        $response->assertRedirect(route('admin.resource-pages.index'));

        $page = ResourcePage::where('title', 'Cambodia')->firstOrFail();
        $this->assertSame('cambodia', $page->slug);
        $this->assertTrue($page->is_active);
        $this->assertSame(5, $page->sort_order);
        Storage::disk('public')->assertExists($page->image);

        $this->assertSame('Schools built', $page->items[0]['title']);
    }

    public function test_admin_can_view_list_create_and_edit_pages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $page = ResourcePage::create([
            'title' => 'Health and Hygiene',
            'slug' => 'health-and-hygiene',
            'is_active' => true,
        ]);

        $this->actingAs($admin)->get(route('admin.resource-pages.index'))
            ->assertOk()
            ->assertSee('Health and Hygiene');

        $this->actingAs($admin)->get(route('admin.resource-pages.create'))
            ->assertOk()
            ->assertSee('Create New Topic');

        $this->actingAs($admin)->get(route('admin.resource-pages.edit', $page))
            ->assertOk()
            ->assertSee('Edit Topic');
    }

    public function test_admin_can_update_a_topic_and_existing_item_image_survives_a_text_only_edit(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $itemImagePath = UploadedFile::fake()->create('item.jpg', 10, 'image/jpeg')->store('resource-pages/items', 'public');

        $page = ResourcePage::create([
            'title' => 'France',
            'slug' => 'france',
            'is_active' => true,
            'items' => [
                ['title' => 'Old title', 'description' => 'Old desc', 'image' => $itemImagePath],
            ],
        ]);

        $response = $this->actingAs($admin)->put(route('admin.resource-pages.update', $page), [
            'title' => 'France Renamed',
            'is_active' => '1',
            'sort_order' => '0',
            'items' => [
                0 => ['title' => 'New title', 'description' => 'New desc'],
            ],
        ]);

        $response->assertRedirect(route('admin.resource-pages.index'));

        $page->refresh();
        $this->assertSame('France Renamed', $page->title);
        $this->assertSame('france-renamed', $page->slug);
        $this->assertSame('New title', $page->items[0]['title']);
        $this->assertSame($itemImagePath, $page->items[0]['image']);
        Storage::disk('public')->assertExists($itemImagePath);
    }

    public function test_admin_can_delete_a_topic_and_its_files_are_removed(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $imagePath = UploadedFile::fake()->create('cover.jpg', 10, 'image/jpeg')->store('resource-pages', 'public');

        $page = ResourcePage::create([
            'title' => 'Child Welfare',
            'slug' => 'child-welfare',
            'is_active' => true,
            'image' => $imagePath,
        ]);

        $this->actingAs($admin)->delete(route('admin.resource-pages.destroy', $page))
            ->assertRedirect(route('admin.resource-pages.index'));

        $this->assertDatabaseMissing('resource_pages', ['id' => $page->id]);
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_non_admin_cannot_manage_topics(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.resource-pages.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_news_tag_without_a_stored_url_still_links_to_the_matching_topic_page(): void
    {
        ResourcePage::create([
            'title' => 'Cambodia',
            'slug' => 'cambodia',
            'is_active' => true,
        ]);

        News::create([
            'title' => 'Custom Tag Article',
            'slug' => 'custom-tag-article',
            'is_published' => true,
            'published_at' => now(),
            'tag_links' => [
                ['label' => 'Cambodia', 'url' => null],
            ],
        ]);

        $this->get(route('news.show', 'custom-tag-article'))
            ->assertOk()
            ->assertSee('/topics/cambodia', false);
    }
}
