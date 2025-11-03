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
            $table->foreignId('transport_status_id')->nullable()->constrained('transport_statuses')->after('user_id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transport_internes', function (Blueprint $table) {
            $table->dropForeign(['transport_status_id']);
            $table->dropColumn('transport_status_id');
        });
    }
};
