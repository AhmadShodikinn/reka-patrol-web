<?php

namespace Database\Seeders;

use App\Models\RekapSafetyPatrol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekapSafetyPatrolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RekapSafetyPatrol::create([
            'no' => 'RSP001',
            'Tgl_terbit' => '2025-03-14',
            'Tgl_awal' => '2025-03-01',
            'Tgl_Akhir' => '2025-03-15',
            'Keterangan' => 'Rekap keselamatan patroli selama periode Maret 2025'
        ]);
    }
}
