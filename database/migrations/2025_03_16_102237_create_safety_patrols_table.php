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
        Schema::create('safety_patrols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('users');
            $table->foreignId('pic_id')->nullable()->constrained('users');
            $table->string('findings_path');
            $table->string('findings_description');
            $table->string('location');
            $table->enum('category', ['Unsafe Condition', "Unsafe Action"]);
            $table->string('risk');
            $table->date('checkup_date');
            $table->string('action_path')->nullable();
            $table->string('action_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_patrols');
    }
};
