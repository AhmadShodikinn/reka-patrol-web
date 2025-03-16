<?php

namespace Database\Seeders;

use App\Models\SafetyPatrolRecap;
use Illuminate\Database\Seeder;

class SafetyPatrolRecapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SafetyPatrolRecap::create([
            'number' => 'RSP001',
            'issued_date' => '2025-03-14',
            'from_date' => '2025-03-01',
            'to_date' => '2025-03-15',
            'description' => 'Rekap keselamatan patroli selama periode Maret 2025'
        ]);
    }
}
