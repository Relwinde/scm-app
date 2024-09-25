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
            $table->string('num_commande');
            $table->string('num_fature');
            $table->string('num_dpi');
            $table->string('num_declaration');
            $table->float('v_caf');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');
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
