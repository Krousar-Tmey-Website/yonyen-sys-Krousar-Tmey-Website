<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('subtitle_fr')->nullable();
            $table->text('description')->nullable();
            $table->text('description_fr')->nullable();
            $table->string('extra_heading')->nullable();
            $table->string('extra_heading_fr')->nullable();
            $table->text('extra_content')->nullable();
            $table->text('extra_content_fr')->nullable();
            $table->string('footer_label')->nullable();
            $table->string('footer_label_fr')->nullable();
            // 'email' -> mailto: link using cta_value, 'modal' -> opens the existing
            // "Apply to Volunteer" application modal, 'url' -> plain link to cta_value.
            $table->string('cta_type')->default('url');
            $table->string('cta_value')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_text_fr')->nullable();
            $table->string('accent_color', 7)->nullable();
            $table->string('accent_color_secondary', 7)->nullable();
            $table->string('icon_background_color', 7)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('volunteer_tracks')->insert([
            [
                'title' => 'Volunteering in Cambodia',
                'subtitle' => 'Locational Track',
                'description' => 'At Krousar Thmey, our priority is for all work to be done by Cambodians. However, the organization welcomes foreign volunteers with a specific project involving knowledge and know-how lacking in Cambodia, that they would be willing to transfer to our Cambodian team.',
                'extra_heading' => 'Requirements & Process:',
                'extra_content' => '<ul><li>Specific project outline focused on knowledge and skills transfer.</li><li>Cooperation with the existing local Cambodian staff.</li><li>Direct review and validation by the communications office.</li></ul>',
                'footer_label' => 'To submit a volunteering project:',
                'cta_type' => 'email',
                'cta_value' => 'communication@krousar-thmey.org',
                'cta_button_text' => 'communication@krousar-thmey.org',
                'accent_color' => '#2d6fa3',
                'accent_color_secondary' => '#8da83a',
                'icon_background_color' => '#dbeafe',
                'sort_order' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Volunteering Internationally',
                'subtitle' => 'International structures',
                'description' => 'Krousar Thmey does not hire any employee in Europe or Singapore. Fundraising, which is the main activity of our international entities, is handled by volunteers.',
                'extra_heading' => 'Ways to help in our entities:',
                'extra_content' => '<p><strong>Voluntary Actions:</strong> Participate within your available time in internal &amp; external communication, funding, mobilization, or administration.</p><p><strong>Fundraising Support:</strong> Mobilize people in your company, host presentation meetings, share films, photos &amp; posters.</p>',
                'footer_label' => 'To learn more and get involved:',
                'cta_type' => 'modal',
                'cta_value' => null,
                'cta_button_text' => 'Apply to Volunteer',
                'accent_color' => '#e8a020',
                'accent_color_secondary' => '#f8bb86',
                'icon_background_color' => '#fef3c7',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_tracks');
    }
};
