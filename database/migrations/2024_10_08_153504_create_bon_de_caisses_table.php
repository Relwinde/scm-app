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
        Schema::create('bon_de_caisses', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 14, 2);
            $table->string('depense');
            $table->enum('etape', ['EMETTEUR', 'RESPONSABLE', 'COMPTABLE', 'RAF', 'MANAGER', 'CAISSE'])->default('EMETTEUR');
            $table->boolean('rejected')->default(false);
            $table->foreignId('dossier_id')->constrained()->onDelete('cascade')->default(null);
            $table->foreignId('transport_interne_id')->constrained()->onDelete('cascade')->default(null);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('numero', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_de_caisses');
    }
};