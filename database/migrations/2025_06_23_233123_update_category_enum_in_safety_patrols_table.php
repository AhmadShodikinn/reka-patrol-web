<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE safety_patrols MODIFY category ENUM('UC', 'AC', 'Unsafe Action', 'Unsafe Condition') NOT NULL");

        Schema::table('safety_patrols', function (Blueprint $table) {
            DB::table('safety_patrols')->where('category', 'UC')->update(['category' => 'Unsafe Condition']);
            DB::table('safety_patrols')->where('category', 'AC')->update(['category' => 'Unsafe Action']);
        });

        DB::statement("ALTER TABLE safety_patrols MODIFY category ENUM('Unsafe Action', 'Unsafe Condition') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE safety_patrols MODIFY category ENUM('Unsafe Action', 'Unsafe Condition', 'UC', 'AC') NOT NULL");

        Schema::table('safety_patrols', function (Blueprint $table) {
            DB::table('safety_patrols')->where('category', 'Unsafe Condition')->update(['category' => 'UC']);
            DB::table('safety_patrols')->where('category', 'Unsafe Action')->update(['category' => 'AC']);
        });

        DB::statement("ALTER TABLE safety_patrols MODIFY category ENUM('UC', 'AC') NOT NULL");
    }
};
