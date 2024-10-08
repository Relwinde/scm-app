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
        Schema::create('bon_de_caisse_commentaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_de_caisses_id')->constrained()->onDelete('cascade');
            $table->foreignId('commentaires_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_de_caisse_observation');
    }
};
