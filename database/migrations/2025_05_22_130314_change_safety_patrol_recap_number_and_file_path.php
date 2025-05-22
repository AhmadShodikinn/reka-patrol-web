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
        Schema::table('safety_patrol_recaps', function (Blueprint $table) {
            $table->string('number')->nullable()->change();
            $table->string('file_path')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_patrol_recaps', function (Blueprint $table) {
            $table->string('number')->change();
            $table->dropColumn('file_path');
        });
    }
};
