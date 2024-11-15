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
        Schema::create('bon_de_caisse_commentaires', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->enum('etape', ['EMETTEUR', 'RESPONSABLE', 'MANAGER', 'RAF', 'CAISSE', 'PAYE', 'CLOS'])->default('EMETTEUR');
            $table->foreignId('bon_de_caisse_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
