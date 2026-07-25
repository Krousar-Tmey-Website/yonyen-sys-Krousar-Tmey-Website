<?php

namespace Tests\Feature;

use App\Models\HomeSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SocialIconUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_debug_upload_flow(): void
    {
        $file = UploadedFile::fake()->image('custom-facebook.png', 1, 1);
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->post(route('admin.website.update'), [
                '_token' => csrf_token(),
                'settings' => [
                    'sharing_facebook_icon' => 'images/social/facebook.svg',
                    'site_name' => 'Krousar Thmey',
                    'site_tagline' => 'Test',
                ],
                'sharing_facebook_icon_file' => $file,
            ]);

        $response->assertRedirect(route('admin.website.index'));
        $response->assertSessionHas('success', 'Website settings saved successfully.');

        $value = HomeSetting::getValue('sharing_facebook_icon', '');

        $this->assertStringStartsWith('social/', $value);
        Storage::disk('public')->assertExists($value);
    }
}
