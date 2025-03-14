<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokasi = [
            'Workshop/Gudang',
            'Kantor',
        ];

        foreach ($lokasi as $lokasiSeed) {
            Lokasi::create([
                'nama_lokasi' => $lokasiSeed,
            ]);
        }
    }
}
