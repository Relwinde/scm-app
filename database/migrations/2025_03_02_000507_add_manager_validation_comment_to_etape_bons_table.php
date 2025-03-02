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
            $table->text('manager_validation_comment')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etape_bons', function (Blueprint $table) {
            $table->dropColumn('manager_validation_comment');
        });
    }
};
