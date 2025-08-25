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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->decimal('fob_devis', 14, 2);
            $table->decimal('fob_xof', 14, 2);
            $table->decimal('fret', 14, 2);
            $table->decimal('autres_frais', 14, 2);
            $table->decimal('assurance', 14, 2);
            $table->decimal('caf', 14, 2);
            $table->decimal('poids_brut', 14, 2);
            $table->decimal('poids_net', 14, 2);
            $table->decimal('quantite', 14, 2);
            $table->foreignId('dossier_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
