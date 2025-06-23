<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\SafetyPatrol;
use App\Models\User;
use Illuminate\Database\Seeder;

class SafetyPatrolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $worker = User::wherePositionId(Position::wherePositionName('5R')->first()->id)->first(); // Mengambil user dengan posisi 5R sebagai contoh worker
        $pic = User::wherePositionId(Position::wherePositionName('PIC')->first()->id)->first(); // Mengambil user dengan posisi PIC sebagai PIC

        // Menambahkan data safety patrol
        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'pic_id' => $pic->id,
            // 'findings_path' => 'path/to/temuan/file1.pdf',
            'findings_description' => 'Deskripsi temuan untuk safety patrol pertama.',
            'location' => 'Area Workshop 1',
            'category' => 'Unsafe Condition',
            'risk' => 'Tinggi',
            'checkup_date' => now(),
            'action_path' => 'path/to/tindak_lanjut/file1.pdf',
            'action_description' => 'Deskripsi tindak lanjut untuk temuan pertama.',
        ]);

        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'pic_id' => $pic->id,
            // 'findings_path' => 'path/to/temuan/file2.pdf',
            'findings_description' => 'Deskripsi temuan untuk safety patrol kedua.',
            'location' => 'Area Workshop 2',
            'category' => 'Unsafe Action', 
            'risk' => 'Sedang',
            'checkup_date' => now(), // Tanggal 3 hari yang lalu
            'action_path' => 'path/to/tindak_lanjut/file2.pdf',
            'action_description' => 'Deskripsi tindak lanjut untuk temuan kedua.',
        ]);

        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'pic_id' => $pic->id,
            // 'findings_path' => 'path/to/temuan/file3.pdf',
            'findings_description' => 'Deskripsi temuan untuk safety patrol ketiga.',
            'location' => 'Area Workshop 3',
            'category' => 'Unsafe Condition',
            'risk' => 'Rendah',
            'checkup_date' => now(), // Tanggal kemarin
            'action_path' => 'path/to/tindak_lanjut/file3.pdf',
            'action_description' => 'Deskripsi tindak lanjut untuk temuan ketiga.',
        ]);
    }
}
