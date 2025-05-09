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
        Schema::create('marchandise_transport_interne', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_interne_id')->constrained()->onDelete('cascade');
            $table->foreignId('marchandise_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marchandise_transport_interne');
    }
};
