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
        Schema::table('etape_bons', function (Blueprint $table) {
            $table->decimal('montant', 14, 2)->after('etape_actuelle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etape_bons', function (Blueprint $table) {
            $table->dropColumn('montant');
        });
    }
};
