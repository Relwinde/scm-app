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
        Schema::table('transport_internes', function (Blueprint $table) {
            $table->integer('nombre_colis')->nullable();
            $table->decimal('poids', 14, 2)->nullable();
            $table->decimal('volume', 14, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transport_internes', function (Blueprint $table) {
            $table->dropColumn('nombre_colis');
            $table->dropColumn('poids');
            $table->dropColumn('volume');
            
        });
    }
};
