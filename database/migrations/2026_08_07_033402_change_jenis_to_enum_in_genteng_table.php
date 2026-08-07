<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $enums = ['Reng', 'Reng Cat', 'Wuwung', 'Wuwung Cat', 'Variasi'];
        
        $gentengs = DB::table('genteng')->get();
        foreach ($gentengs as $genteng) {
            DB::table('genteng')->where('id', $genteng->id)->update([
                'jenis' => $enums[array_rand($enums)]
            ]);
        }

        Schema::table('genteng', function (Blueprint $table) {
            $table->enum('jenis', ['Reng', 'Reng Cat', 'Wuwung', 'Wuwung Cat', 'Variasi'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('genteng', function (Blueprint $table) {
            $table->string('jenis', 255)->change();
        });
    }
};
