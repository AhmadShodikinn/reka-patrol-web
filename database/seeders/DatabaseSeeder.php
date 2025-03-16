<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationSeeder::class,
            CriteriaSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            SafetyPatrolSeeder::class,
            SafetyPatrolRecapSeeder::class,
            InspectionSeeder::class,
        ]);
    }
}
