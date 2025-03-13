<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create(['position_name' => 'Admin']);
        Position::create(['position_name' => '5R']);
        Position::create(['position_name' => 'SHE']);
        Position::create(['position_name' => 'PIC']);
        Position::create(['position_name' => 'Manajemen']);
    }
}
