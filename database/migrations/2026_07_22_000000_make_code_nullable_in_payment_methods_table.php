<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('code', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Assign a placeholder code to any records with null code
        // before reverting the NOT NULL constraint
        \Illuminate\Support\Facades\DB::table('payment_methods')
            ->whereNull('code')
            ->orderBy('id')
            ->each(function ($method) {
                $code = strtoupper(\Illuminate\Support\Str::of($method->name ?? 'PM')
                    ->replace([' Bank', ' Banking', ' Ltd', ' PLC'], '')
                    ->trim()
                    ->substr(0, 50));

                $original = $code;
                $counter = 1;
                while (\Illuminate\Support\Facades\DB::table('payment_methods')
                    ->where('code', $code)
                    ->where('id', '!=', $method->id)
                    ->exists()
                ) {
                    $suffix = (string) $counter;
                    $code = substr($original, 0, 50 - strlen($suffix) - 1) . '_' . $suffix;
                    $counter++;
                }

                \Illuminate\Support\Facades\DB::table('payment_methods')
                    ->where('id', $method->id)
                    ->update(['code' => $code]);
            });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('code', 50)->nullable(false)->change();
        });
    }
};
