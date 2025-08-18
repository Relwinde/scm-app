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
            $table->string('num_lta_bl')->nullable()->after('numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transport_internes', function (Blueprint $table) {
            $table->dropColumn('num_lta_bl');
        });
    }
};
