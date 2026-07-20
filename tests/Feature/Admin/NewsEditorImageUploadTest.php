<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NewsEditorImageUploadTest extends TestCase
{
    private array $tempFiles = [];

    protected function setUp(): void
    {
        parent::setUp();

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
    }

    protected function tearDown(): void
    {
        foreach ($this->tempFiles as $path) {
            if (is_file($path)) {
                @unlink($path);
            }
        }

        parent::tearDown();
    }

    public function test_admin_can_upload_and_read_editor_image(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $file = $this->validPngUpload('presentation.png');

        $response = $this->actingAs($admin)->postJson(route('admin.news.upload-image'), [
            'image' => $file,
        ]);

        $response->assertOk()
            ->assertJsonStructure(['url']);

        $url = $response->json('url');
        $this->assertStringStartsWith('/storage/news/gallery/', $url);

        $storedPath = str_replace('/storage/', '', $url);
        Storage::disk('public')->assertExists($storedPath);

        try {
            $this->get($url)->assertOk();
        } finally {
            Storage::disk('public')->delete($storedPath);
        }
    }

    public function test_non_admin_cannot_upload_editor_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['is_admin' => false]);
        $file = $this->validPngUpload('presentation.png');

        $this->actingAs($user)->postJson(route('admin.news.upload-image'), [
            'image' => $file,
        ])->assertRedirect(route('admin.login'));
    }

    private function validPngUpload(string $name): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'news_editor_image_');
        file_put_contents($path, base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGA' .
            'WjI9ZgAAAABJRU5ErkJggg=='
        ));

        $this->tempFiles[] = $path;

        return new UploadedFile($path, $name, 'image/png', null, true);
    }
}
