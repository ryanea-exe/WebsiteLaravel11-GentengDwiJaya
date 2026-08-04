<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('Genteng Dwijaya');
            $table->string('app_logo')->nullable(); // path relatif dari public/
            $table->timestamps();
        });

        // Seed baris default
        DB::table('settings')->insert([
            'app_name'   => 'Genteng Dwijaya',
            'app_logo'   => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
