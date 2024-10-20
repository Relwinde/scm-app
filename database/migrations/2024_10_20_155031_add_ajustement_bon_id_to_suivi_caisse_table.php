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
        Schema::table('suivi_caisses', function (Blueprint $table) {
            $table->foreignId('ajustement_bon_id')->after('bon_de_caisse_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suivi_caisse', function (Blueprint $table) {
            $table->dropColumn('ajustement_bon_id');
        });
    }
};
