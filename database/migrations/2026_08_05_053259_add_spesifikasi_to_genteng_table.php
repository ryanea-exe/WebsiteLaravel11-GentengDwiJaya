<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('genteng', function (Blueprint $table) {
            $table->string('jarak_reng')->nullable()->after('deskripsi');
            $table->string('dimensi')->nullable()->after('jarak_reng');
            $table->string('isi_per_m2')->nullable()->after('dimensi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('genteng', function (Blueprint $table) {
            $table->dropColumn(['jarak_reng', 'dimensi', 'isi_per_m2']);
        });
    }
};
