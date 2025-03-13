<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::create(['jenis_kriteria' => 'Rapi']);
        Jenis::create(['jenis_kriteria' => 'Resik']);
        Jenis::create(['jenis_kriteria' => 'Rawat']);
        Jenis::create(['jenis_kriteria' => 'Rajin']);
        Jenis::create(['jenis_kriteria' => 'Ringkas']);
    }
}
