<?php

namespace Tests\Feature;

use App\Models\HomeSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SocialIconUploadTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_debug_upload_flow(): void
    {
        // Create a valid PNG (1x1 pixel) - getimagesize can read this
        $tempPath = tempnam(sys_get_temp_dir(), 'test_png') . '.png';
        $pngContent = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGA' .
            'WjI9ZgAAAABJRU5ErkJggg=='
        );
        file_put_contents($tempPath, $pngContent);

        echo 'Temp file: ' . $tempPath . PHP_EOL;
        echo 'Temp file size: ' . filesize($tempPath) . PHP_EOL;
        $size = @getimagesize($tempPath);
        echo 'getimagesize result: ';
        var_dump($size);

        $file = new UploadedFile($tempPath, 'custom-facebook.png', 'image/png', 0, true);

        // Manually authenticate and post
        $admin = \App\Models\User::where('email', 'admin@krousar-thmey.org')->first();
        $this->assertNotNull($admin, 'Admin user exists');

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

        echo 'Response status: ' . $response->getStatusCode() . PHP_EOL;

        // Follow redirect if any
        if ($response->isRedirect()) {
            $response = $this->followRedirects();
        }

        echo 'Final status: ' . $response->getStatusCode() . PHP_EOL;
        echo 'Session success: ';
        var_dump(session('success'));

        $errors = session('errors');
        if ($errors) {
            echo 'Session errors: ' . json_encode($errors->all()) . PHP_EOL;
        } else {
            echo 'No session errors' . PHP_EOL;
        }

        $val = HomeSetting::getValue('sharing_facebook_icon', 'DEFAULT');
        echo 'sharing_facebook_icon value: ' . $val . PHP_EOL;

        @unlink($tempPath);
    }
}
