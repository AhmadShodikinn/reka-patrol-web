<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
            Location::create([
                'location_name' => $lokasiSeed,
            ]);
        }
    }
}
