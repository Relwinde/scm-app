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
        Schema::create('transport_status_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_status_id')->constrained('transport_statuses')->onDelete('cascade');
            $table->foreignId('to_status_id')->constrained('transport_statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_status_transactions');
    }
};
