<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
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
            'position_id' => $adminPosition->id,
            'nip' => '001',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi 5R
        User::create([
            'position_id' => $fiveRPosition->id,
            'nip' => '002',
            'name' => '5R User',
            'email' => '5r@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi SHE
        User::create([
            'position_id' => $shePosition->id,
            'nip' => '003',
            'name' => 'SHE User',
            'email' => 'she@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi PIC
        User::create([
            'position_id' => $picPosition->id,
            'nip' => '004',
            'name' => 'PIC User',
            'email' => 'pic@example.com',
            'password' => Hash::make('password'),
        ]);

        // Menambahkan user dengan posisi Manajemen
        User::create([
            'position_id' => $manajemenPosition->id,
            'nip' => '005',
            'name' => 'Manajemen User',
            'email' => 'manajemen@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
