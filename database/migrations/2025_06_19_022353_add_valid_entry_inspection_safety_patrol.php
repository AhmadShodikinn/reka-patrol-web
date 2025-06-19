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
        Schema::table('inspections', function (Blueprint $table) {
            if (!Schema::hasColumn('inspections', 'is_valid_entry')) {
                $table->boolean('is_valid_entry')->after('inspection_location')->nullable();
            }
        });

        Schema::table('safety_patrols', function (Blueprint $table) {
            if (!Schema::hasColumn('safety_patrols', 'is_valid_entry')) {
                $table->boolean('is_valid_entry')->after('category')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            if (Schema::hasColumn('inspections', 'is_valid_entry')) {
                $table->dropColumn('is_valid_entry');
            }
        });

        Schema::table('safety_patrols', function (Blueprint $table) {
            if (Schema::hasColumn('safety_patrols', 'is_valid_entry')) {
                $table->dropColumn('is_valid_entry');
            }
        });
    }
};
