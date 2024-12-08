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
        Schema::create('numero_transports', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('transport_interne_id')->nullable()->constrained()->onDelete('cascade')->before('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numero_transports');
    }
};
