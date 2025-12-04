<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reports', function (Blueprint $table) {
        // Menyimpan path foto bukti perbaikan
        $table->string('resolution_image')->nullable()->after('status'); 
        // Menyimpan catatan teknis apa yang dilakukan
        $table->text('resolution_note')->nullable()->after('resolution_image'); 
        // Waktu tepatnya diselesaikan (untuk menghitung durasi pengerjaan/SLA)
        $table->timestamp('resolved_at')->nullable()->after('resolution_note');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
