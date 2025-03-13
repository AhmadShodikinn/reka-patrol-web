<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan kriteria untuk jenis Ringkas
        $jenisRingkas = Jenis::where('jenis_kriteria', 'Ringkas')->first();
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Tidak ada barang yang tidak diperlukan di area mesin/tempat kerja.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Tidak ada barang yang cacat/rusak di workshop/tempat kerja.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Tidak ada kebocoran instalasi power plan (Air, Udara, Gas dan Listrik).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Alat kerja (Tools, ATK, Perangkat IT) dikelola dan dikendalikan (ada daftar pemegang tools).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Terdapat tempat penampungan barang sementara.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Ada pelabelan barang yang tidak diperlukan.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Ada tempat/kotak Scrap (warna kuning).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Ada tempat sampah B3 (warna merah).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Ada tempat sampah Domestik untuk di daur ulang (warna hijau).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRingkas->id,
            'Nama_kritera' => 'Scrap/Limbah B3 tidak tercampur dengan sampah domestik.'
        ]);

        // Menambahkan kriteria untuk jenis Rapi
        $jenisRapi = Jenis::where('jenis_kriteria', 'Rapi')->first();
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Label, identitas, instruksi kerja, prosedur setiap mesin jelas dan barang tertata rapi (Material, Mesin, dll).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Penempatan pada tempat khusus benda-benda kerja (tools) dan disederhanakan (pengelompokan barang).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Pada lingkungan workshop ada pembagian daerah (layout) dan tanda penempatan.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Ada pemberian kertas label pada barang (gudang).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Penempatan barang sesuai fungsinya.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Alat kebersihan disimpan dengan baik dan pada tempatnya.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Penempatan APD tertata rapi sesuai dengan tempat penyimpanannya.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRapi->id,
            'Nama_kritera' => 'Selang Udara dan selang gas tertata rapi.'
        ]);

        // Menambahkan kriteria untuk jenis Resik
        $jenisResik = Jenis::where('jenis_kriteria', 'Resik')->first();
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Kotoran/sampah dibuang pada tempatnya.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Tidak ada sumber kotor (Debu, Air, Jamur dan sarang laba-laba).'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Cat dinding, lantai terang dan bersih, serta layout area terlihat jelas.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Tempat kerja/ruangan, workshop/gudang bagian atas dalam kondisi bersih.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Tools, APAR, mesin dan peralatan kerja terpelihara dengan baik dan dalam kondisi bersih.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Label, identitas mesin, warning sign terlihat jelas dan tidak kotor.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Tidak ada tumpahan dan ceceran minyak, oli, cat, dll, di lantai, fasilitas kerja dan alat kerja.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisResik->id,
            'Nama_kritera' => 'Papan informasi terlihat jelas, dalam kondisi bersih dan tidak terhalang/tumpang tindih.'
        ]);

        // Menambahkan kriteria untuk jenis Rawat
        $jenisRawat = Jenis::where('jenis_kriteria', 'Rawat')->first();
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Lokasi penempatan material/spare part sesuai dengan ketentuan, identitas, label jelas dan ada standar penyimpanan atau penumpukan.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Terdapat jadwal inspeksi/maintenance mesin, perawatan peralatan, serta pemeriksaan secara rutin forklift.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Alat kebersihan, spill kit, dan alat keselamatan terawat dengan baik, serta penempatan yang sesuai.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Terdapat daftar inventaris barang (alat kerja, apd, spare part, dll) beserta jumlahnya, serta penempatan yang sesuai.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Terdapat denah evakuasi serta jadwal, standar dan checklist kebersihan ruangan, toilet, dll.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRawat->id,
            'Nama_kritera' => 'Terdapat papan informasi 5R yang selalu up to date.'
        ]);

        // Menambahkan kriteria untuk jenis Rajin
        $jenisRajin = Jenis::where('jenis_kriteria', 'Rajin')->first();
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Personel di area kerja secara rutin dan aktif menjalankan program 5R, 5 menit sebelum memulai bekerja dan 5 menit sebelum selesai bekerja.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Mereview prosedur peralatan kerja secara rutin.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Jadwal inspeksi/maintenance mesin, perawatan peralatan, serta pemeriksaan secara rutin forklift terealisasi sesuai rencana.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Prosedur/ketentuan pengendalian barang (alat kerja, apd, spare part, dll) telah dipatuhi sebagai upaya minimalisasi jumlah.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Selalu dilakukan pelatihan jika terdapat proses parameter setting mesin, standar preventive, prosedur operasi mesin, yang baru.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Informasi 5R secara rutin diperbarui dengan ide-ide Kaizen, termasuk hasil pemeriksaan patroli, tinjauan manajemen, dan audit internal maupun eksternal.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Area kerja selalu bersih, rapi dan memenuhi estetika setiap sebelum dimulai kerja.'
        ]);
        Kriteria::create([
            'id_jenis' => $jenisRajin->id,
            'Nama_kritera' => 'Terdapat tanaman hijau yang tumbuh terawat, disiram dan bersih di area kerja.'
        ]);
    }
}
