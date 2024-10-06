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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('num_commande')->nullable();
            $table->string('num_facture')->nullable();
            $table->string('num_sylvie')->nullable();
            $table->string('num_declaration')->nullable();
            $table->string('num_exo')->nullable();
            $table->string('num_t')->nullable();
            $table->string('num_lta_bl')->nullable();
            $table->string('fournisseur')->nullable();
            $table->string('devise_marchandise')->nullable();
            $table->decimal('valeur_caf', 14, 2)->nullable();
            $table->decimal('valeur_marchandise', 14, 2)->nullable();
            $table->decimal('nombre_colis', 14, 2)->nullable();
            $table->decimal('poids', 14, 2)->nullable();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('bureau_de_douane_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
