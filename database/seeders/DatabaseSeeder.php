<?php

namespace Database\Seeders;

use App\Models\SafetyPatrol;
use App\Models\User;
use Database\Seeders\InspectionSeeder as SeedersInspectionSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use InspectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LokasiSeeder::class,
            RekapSafetyPatrolSeeder::class,
            JenisSeeder::class,
            KriteriaSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            SafetyPatrolSeeder::class,
            SeedersInspectionSeeder::class,            
        ]);
    }
}
