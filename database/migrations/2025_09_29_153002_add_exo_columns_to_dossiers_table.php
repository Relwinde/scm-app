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
        Schema::table('dossiers', function (Blueprint $table) {
            $table->string('numero_bi')->nullable()->after('num_declaration');
            $table->string('numero_demande_exo')->nullable()->after('numero_bi');
            $table->string('numero_decision_exo')->nullable()->after('numero_demande_exo');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropColumn(['numero_exo', 'numero_demande_exo', 'numero_decision_exo']);
        });
    }
};
