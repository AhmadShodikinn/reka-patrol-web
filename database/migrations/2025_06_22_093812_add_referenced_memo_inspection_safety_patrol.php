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
            if (!Schema::hasColumn('inspections', 'memo_id')) {
                $table->foreignId('memo_id')->after('is_valid_entry')->nullable()->constrained('documents');
            }
        });

        Schema::table('safety_patrols', function (Blueprint $table) {
            if (!Schema::hasColumn('safety_patrols', 'memo_id')) {
                $table->foreignId('memo_id')->after('is_valid_entry')->nullable()->constrained('documents');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropForeign(['memo_id']);
            $table->dropColumn('memo_id');
        });

        Schema::table('safety_patrols', function (Blueprint $table) {
            $table->dropForeign(['memo_id']);
            $table->dropColumn('memo_id');
        });
    }
};
