<?php

namespace Tests\Feature\Admin;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Vite;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class NewsManagementAjaxTest extends TestCase
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

    public function test_admin_can_create_news_without_page_reload(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->postJson(route('admin.news.store'), [
            'title' => 'No Reload Article',
            'excerpt' => 'Saved from the admin page without a full reload.',
            'content' => '<p>Article body</p>',
            'is_published' => '1',
            'tag_links' => json_encode([
                ['label' => 'Education', 'url' => '/topics/education'],
            ]),
        ]);

        $response->assertCreated()
            ->assertJsonPath('message', 'Article created successfully.')
            ->assertJsonStructure(['news' => ['id', 'title', 'edit_url', 'update_url', 'index_url', 'public_url']]);

        $this->assertDatabaseHas('news', [
            'title' => 'No Reload Article',
            'is_published' => true,
        ]);

        $news = News::where('title', 'No Reload Article')->firstOrFail();
        $this->assertSame('Education', $news->tag_links[0]['label']);
        $this->assertSame('/topics/education', $news->tag_links[0]['url']);
    }

    public function test_admin_can_open_manage_and_delete_news_articles(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $news = News::create([
            'title' => 'Managed Article',
            'slug' => 'managed-article',
            'excerpt' => 'Admin can manage this article.',
            'content' => '<p>Managed content.</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->actingAs($admin)->get(route('admin.news.index'))
            ->assertOk()
            ->assertSee('Managed Article');

        $this->actingAs($admin)->get(route('admin.news.create'))
            ->assertOk()
            ->assertSee('Create New Article');

        $this->actingAs($admin)->get(route('admin.news.show', $news))
            ->assertOk()
            ->assertSee('Managed Article');

        $this->actingAs($admin)->get(route('admin.news.edit', $news))
            ->assertOk()
            ->assertSee('Edit Article');

        $this->actingAs($admin)->delete(route('admin.news.destroy', $news))
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas('success', 'Article deleted.');

        $this->assertDatabaseMissing('news', [
            'id' => $news->id,
        ]);
    }

    public function test_non_admin_cannot_manage_news_articles(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.news.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_update_news_without_page_reload(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $news = News::create([
            'title' => 'Original Article',
            'slug' => 'original-article',
            'is_published' => false,
        ]);

        $response = $this->actingAs($admin)->putJson(route('admin.news.update', $news), [
            'title' => 'Updated Article',
            'excerpt' => 'Updated without a full reload.',
            'content' => '<p>Updated body</p>',
            'is_published' => '1',
            'tag_links' => json_encode([
                ['label' => 'Cambodia', 'url' => '/topics/cambodia'],
            ]),
        ]);

        $response->assertOk()
            ->assertJsonPath('message', 'Article updated successfully.')
            ->assertJsonPath('news.title', 'Updated Article')
            ->assertJsonStructure(['news' => ['id', 'title', 'edit_url', 'update_url', 'index_url', 'public_url']]);

        $this->assertDatabaseHas('news', [
            'id' => $news->id,
            'title' => 'Updated Article',
            'is_published' => true,
        ]);

        $news->refresh();
        $this->assertSame('Cambodia', $news->tag_links[0]['label']);
        $this->assertSame('/topics/cambodia', $news->tag_links[0]['url']);
    }

    public function test_quick_add_tags_are_visible_to_website_visitors(): void
    {
        News::create([
            'title' => 'Visitor Tag Article',
            'slug' => 'visitor-tag-article',
            'excerpt' => 'Visitors should see quick-added tags.',
            'content' => '<p>Article with quick tags.</p>',
            'is_published' => true,
            'published_at' => now(),
            'tag_links' => [
                ['label' => 'Education', 'url' => '/topics/education'],
                ['label' => 'Cambodia', 'url' => null],
            ],
        ]);

        $this->get(route('news'))
            ->assertOk()
            ->assertSee('Education')
            ->assertSee('/topics/education', false)
            ->assertSee('Cambodia');

        $this->get(route('news.show', 'visitor-tag-article'))
            ->assertOk()
            ->assertSee('Education')
            ->assertSee('/topics/education', false)
            ->assertSee('Cambodia');
    }
}
