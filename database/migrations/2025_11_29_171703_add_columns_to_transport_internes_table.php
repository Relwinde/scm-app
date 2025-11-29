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
            $table->string('numero_facture_scm')->nullable();
            $table->date('date_paiement')->nullable()->after('numero_facture_scm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transport_internes', function (Blueprint $table) {
            $table->dropColumn('numero_facture_scm');
            $table->dropColumn('date_paiement');
        });
    }
};
