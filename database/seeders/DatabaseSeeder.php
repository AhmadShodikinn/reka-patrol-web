<?php

namespace Database\Seeders;

use App\Models\SafetyPatrol;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RekapSafetyPatrolSeeder::class,
            JenisSeeder::class,
            KriteriaSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            SafetyPatrolSeeder::class,
            InspectionSeeder::class,            
        ]);
    }
}
