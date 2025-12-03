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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // PERBAIKAN DISINI: Gunakan foreignUuid, bukan foreignId
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); 
            
            // 1. Tipe Aset (Sarana / Prasarana)
            $table->string('asset_type'); 
            
            // 2. Tipe Laporan (Kerusakan / Komplain / Saran)
            $table->string('report_type'); 
            
            // 3. Nama Objek (Text Field Manual)
            $table->string('object_name'); 
            
            // 4. Lokasi
            $table->string('location');
            
            // 5. Foto Bukti (Path filenya)
            $table->string('photo_path')->nullable();
            
            // 6. Jumlah (Optional)
            $table->integer('quantity')->nullable()->default(1);
            
            // 7. Deskripsi / Catatan
            $table->text('description');
            
            // Status Laporan
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};