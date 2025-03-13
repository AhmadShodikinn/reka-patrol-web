<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\Kriteria;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $worker = User::where('id_position', Position::where('position_name', '5R')->first()->id)->first(); // Worker dengan posisi 5R
        $pic = User::where('id_position', Position::where('position_name', 'PIC')->first()->id)->first(); // PIC dengan posisi PIC

        // Mengambil beberapa kriteria untuk inspeksi
        $kriteriaRapi = Kriteria::where('id_jenis', 1)->first();  // Kriteria untuk jenis 'Rapi'
        $kriteriaResik = Kriteria::where('id_jenis', 2)->first();  // Kriteria untuk jenis 'Resik'
        $kriteriaRingkas = Kriteria::where('id_jenis', 3)->first();  // Kriteria untuk jenis 'Ringkas'

        // Menambahkan data inspeksi
        Inspection::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'kriteria_id' => $kriteriaRapi->id,
            'temuan_path' => 'path/to/temuan/inspeksi1.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan inspeksi pertama.',
            'lokasi_inspeksi' => 'Area Workshop 1',
            'nilai' => 'Baik',
            'kesesuaian' => true,
            'Tgl_pemeriksaan' => now(),
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/inspeksi1.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk inspeksi pertama.',
        ]);

        Inspection::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'kriteria_id' => $kriteriaResik->id,
            'temuan_path' => 'path/to/temuan/inspeksi2.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan inspeksi kedua.',
            'lokasi_inspeksi' => 'Area Workshop 2',
            'nilai' => 'Cukup',
            'kesesuaian' => false,
            'Tgl_pemeriksaan' => now(),
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/inspeksi2.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk inspeksi kedua.',
        ]);

        Inspection::create([
            'worker_id' => $worker->id,
            'PIC_id' => $pic->id,
            'kriteria_id' => $kriteriaRingkas->id,
            'temuan_path' => 'path/to/temuan/inspeksi3.pdf',
            'deskripsi_temuan' => 'Deskripsi temuan inspeksi ketiga.',
            'lokasi_inspeksi' => 'Area Workshop 3',
            'nilai' => 'Kurang',
            'kesesuaian' => false,
            'Tgl_pemeriksaan' => now(),
            'tindak_lanjut_path' => 'path/to/tindak_lanjut/inspeksi3.pdf',
            'deskripsi_tindak_lanjut' => 'Deskripsi tindak lanjut untuk inspeksi ketiga.',
        ]);
    }
}
