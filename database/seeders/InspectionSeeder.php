<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inspection;
use App\Models\User;
use App\Models\Kriteria;
use Faker\Factory as Faker;

class InspectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil beberapa worker_id dan PIC_id dari tabel users yang sudah ada
        $workers = User::all()->pluck('id')->toArray();
        $pics = User::all()->pluck('id')->toArray();
        $kriterias = Kriteria::all()->pluck('id')->toArray();

        $lokasiInspeksi = ['Workshop', 'Gudang', 'Kantor'];

        for ($i = 0; $i < 50; $i++) {
            $kriteriaId = $faker->randomElement($kriterias);
            $lokasi = $faker->randomElement($lokasiInspeksi);
            $nilai = $faker->randomFloat(2, 1, 5);
            $kesesuaian = $faker->boolean();
            $tglPemeriksaan = $faker->dateTimeThisYear();

            Inspection::create([
                'worker_id' => $faker->randomElement($workers),
                'PIC_id' => $faker->randomElement($pics),
                'kriteria_id' => $kriteriaId,
                'temuan_path' => $faker->imageUrl(640, 480, 'nature', true),
                'deskripsi_temuan' => $faker->sentence(10),
                'lokasi_inspeksi' => $lokasi,
                'nilai' => $nilai,
                'kesesuaian' => $kesesuaian,
                'Tgl_pemeriksaan' => $tglPemeriksaan,
                'tindak_lanjut_path' => $faker->imageUrl(640, 480, 'business', true),
                'deskripsi_tindak_lanjut' => $faker->sentence(10),
            ]);
        }
    }
}
