<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPosition = Position::where('position_name', 'Admin')->first();
        $fiveRPosition = Position::where('position_name', '5R')->first();
        $shePosition = Position::where('position_name', 'SHE')->first();
        $picPosition = Position::where('position_name', 'PIC')->first();
        $manajemenPosition = Position::where('position_name', 'Manajemen')->first();

        // Menambahkan user dengan posisi Admin
        User::create([
            'id_position' => $adminPosition->id,
            'NIP' => '001',
            'fullname' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi 5R
        User::create([
            'id_position' => $fiveRPosition->id,
            'NIP' => '002',
            'fullname' => '5R User',
            'email' => '5r@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi SHE
        User::create([
            'id_position' => $shePosition->id,
            'NIP' => '003',
            'fullname' => 'SHE User',
            'email' => 'she@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi PIC
        User::create([
            'id_position' => $picPosition->id,
            'NIP' => '004',
            'fullname' => 'PIC User',
            'email' => 'pic@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi Manajemen
        User::create([
            'id_position' => $manajemenPosition->id,
            'NIP' => '005',
            'fullname' => 'Manajemen User',
            'email' => 'manajemen@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
