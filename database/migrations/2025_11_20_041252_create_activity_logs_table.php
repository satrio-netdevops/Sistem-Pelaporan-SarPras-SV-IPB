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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id(); // Pwedeng auto-increment ID dito kasi logs lang ito (internal)
            
            // Link sa User na gumawa ng action (UUID)
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('action');  // e.g. "Created Product"
            $table->string('details'); // e.g. "Added: Wireless Mouse"
            
            $table->timestamps(); // Created_at (Kailan nangyari)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
