<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Position;
use Illuminate\Database\Seeder;
use App\Models\Inspection;
use App\Models\User;
use Faker\Factory as Faker;

class InspectionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $lokasiInspeksi = ['Workshop', 'Gudang', 'Kantor'];

        for ($i = 0; $i < 50; $i++) {
            $lokasi = $faker->randomElement($lokasiInspeksi);
            $nilai = $faker->randomFloat(2, 1, 5);
            $kesesuaian = $faker->boolean();
            $tglPemeriksaan = $faker->dateTimeThisYear();

            Inspection::create([
                'worker_id' => User::inRandomOrder()->wherePositionId(Position::wherePositionName('5R')->first()->id)->first()->id,
                'pic_id' => User::inRandomOrder()->wherePositionId(Position::wherePositionName('PIC')->first()->id)->first()->id,
                'criteria_id' => Criteria::inRandomOrder()->first()->id,
                'findings_path' => $faker->imageUrl(640, 480, 'nature', true),
                'findings_description' => $faker->sentence(10),
                'inspection_location' => $lokasi,
                'value' => $nilai,
                'suitability' => $kesesuaian,
                'checkup_date' => $tglPemeriksaan,
                'action_path' => $faker->imageUrl(640, 480, 'business', true),
                'action_description' => $faker->sentence(10),
            ]);
        }
    }
}
