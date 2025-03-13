<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\SafetyPatrol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SafetyPatrolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $worker = User::where('id_position', Position::where('position_name', '5R')->first()->id)->first(); // Mengambil user dengan posisi 5R sebagai contoh worker
        $pic = User::where('id_position', Position::where('position_name', 'PIC')->first()->id)->first(); // Mengambil user dengan posisi PIC sebagai PIC

        // Menambahkan data safety patrol
        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'temuan_path' => 'path/to/temuan/file1.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan untuk safety patrol pertama.',
            'lokasi' => 'Area Workshop 1',
            'kategori' => 'UC',  // UC atau CA
            'resiko' => 'Tinggi',
            'Tgl_pemeriksaan' => now(),
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/file1.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk temuan pertama.',
        ]);

        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'temuan_path' => 'path/to/temuan/file2.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan untuk safety patrol kedua.',
            'lokasi' => 'Area Workshop 2',
            'kategori' => 'CA',  // UC atau CA
            'resiko' => 'Sedang',
            'Tgl_pemeriksaan' => now(), // Tanggal 3 hari yang lalu
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/file2.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk temuan kedua.',
        ]);

        SafetyPatrol::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'temuan_path' => 'path/to/temuan/file3.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan untuk safety patrol ketiga.',
            'lokasi' => 'Area Workshop 3',
            'kategori' => 'UC',  // UC atau CA
            'resiko' => 'Rendah',
            'Tgl_pemeriksaan' => now(), // Tanggal kemarin
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/file3.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk temuan ketiga.',
        ]);
    }
}
