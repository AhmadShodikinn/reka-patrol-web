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
        Schema::create('inspection', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained('users');
            $table->foreignId('PIC_id')->constrained('users');
            $table->foreignId('kriteria_id')->constrained('kriteria');
            $table->string('temuan_path');
            $table->string('deskripsi_temuan');
            $table->string('lokasi_inspeksi');
            $table->string('nilai');
            $table->boolean('kesesuaian');
            $table->date('Tgl_pemeriksaan');
            $table->string('tindak_lanjut_path');
            $table->string('deskripsi_tindak_lanjut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection');
    }
};
