<?php

use App\Models\HomeSetting;
use App\Models\Office;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('flag')->nullable();
            $table->text('address')->nullable();
            $table->text('google_maps_link')->nullable()->comment('Google Maps URL or embed link for the office location');
            $table->string('phone', 100)->nullable();
            $table->string('email', 200)->nullable();
            $table->text('office_hours')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Migrate existing contact data from home_settings into the new offices table
        $countries = [
            ['id' => 'cambodia',    'flag' => '🇰🇭', 'name' => 'Cambodia Office',    'country' => 'Cambodia',    'sort_order' => 1],
            ['id' => 'france',      'flag' => '🇫🇷', 'name' => 'Krousar Thmey France', 'country' => 'France',      'sort_order' => 2],
            ['id' => 'singapore',   'flag' => '🇸🇬', 'name' => 'Krousar Thmey Singapore', 'country' => 'Singapore', 'sort_order' => 3],
            ['id' => 'switzerland', 'flag' => '🇨🇭', 'name' => 'Krousar Thmey Switzerland', 'country' => 'Switzerland', 'sort_order' => 4],
        ];

        $allSettings = HomeSetting::allKeyed();

        foreach ($countries as $country) {
            $address = $allSettings["contact_{$country['id']}_address"] ?? '';
            $phone   = $allSettings["contact_{$country['id']}_phone"] ?? '';
            $email   = $allSettings["contact_{$country['id']}_email"] ?? '';

            Office::create([
                'name'    => $country['name'],
                'country' => $country['country'],
                'flag'    => $country['flag'],
                'address' => $address,
                'phone'   => $phone,
                'email'   => $email,
                'sort_order' => $country['sort_order'],
                'is_active'  => true,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
