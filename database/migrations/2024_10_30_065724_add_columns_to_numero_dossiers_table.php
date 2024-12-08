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
        Schema::table('numero_dossiers', function (Blueprint $table) {
            $table->foreignId('dossier_id')->nullable()->constrained()->onDelete('cascade')->before('id');
            $table->string('numero')->after('dossier_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numero_dossiers', function (Blueprint $table) {
            $table->dropColumn('dossier_id');
            $table->dropColumn('numero');
        });
    }
};
