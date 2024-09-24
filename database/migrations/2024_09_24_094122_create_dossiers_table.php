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
            $table->string('num_commande');
            $table->string('num_facture');
            $table->string('nature_colis');
            $table->string('num_DPI');
            $table->string('num_colis');
            $table->float('poids');
            $table->string('num_LTA');
            $table->string('num_declaration');
            $table->string('V_CAF');
            $table->timestamps();
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
