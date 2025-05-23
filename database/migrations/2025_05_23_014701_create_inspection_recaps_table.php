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
        Schema::create('inspection_recaps', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->date('issued_date');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_recaps');
    }
};
