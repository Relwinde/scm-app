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
        Schema::create('dossier_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dossier_id')->constrained('dossiers')->onDelete('cascade');
            $table->foreignId('from_status_id')->constrained('dossier_status')->onDelete('cascade');
            $table->foreignId('to_status_id')->constrained('dossier_status')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('set null')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_status_history');
    }
};
