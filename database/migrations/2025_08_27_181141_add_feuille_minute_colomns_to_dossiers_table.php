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
            $table->decimal('fret', 10, 2)->after('fob_xof')->nullable();
            $table->decimal('assurance', 10, 2)->after('fret')->nullable();
            $table->decimal('autre_frais', 10, 2)->after('assurance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropColumn('fret');
            $table->dropColumn('assurance');
            $table->dropColumn('autre_frais');
        });
    }
};
