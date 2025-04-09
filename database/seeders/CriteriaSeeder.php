<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\CriteriaType;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedKriteria('Workshop/Gudang', 'Ringkas', [
            'Tidak ada barang yang tidak diperlukan di area mesin/tempat kerja.',
            'Tidak ada barang yang cacat/rusak di workshop/tempat kerja.',
            'Tidak ada kebocoran instalasi power plan (Air, Udara, Gas dan Listrik).',
            'Alat kerja (Tools, ATK, Perangkat IT) dikelola dan dikendalikan (ada daftar pemegang tools).',
            'Terdapat tempat penampungan barang sementara.',
            'Ada pelabelan barang yang tidak diperlukan.',
            'Ada tempat/kotak Scrap (warna kuning).',
            'Ada tempat sampah B3 (warna merah).',
            'Ada tempat sampah Domestik untuk di daur ulang (warna hijau).',
            'Scrap/Limbah B3 tidak tercampur dengan sampah domestik.',
        ]);

        $this->seedKriteria('Workshop/Gudang', 'Rapi', [
            'Label, identitas, instruksi kerja, prosedur setiap mesin jelas dan barang tertata rapi (Material, Mesin, dll).',
            'Penempatan pada tempat khusus benda-benda kerja (tools) dan disederhanakan (pengelompokan barang).',
            'Pada lingkungan workshop ada pembagian daerah (layout) dan tanda penempatan.',
            'Ada pemberian kertas label pada barang (gudang).',
            'Penempatan barang sesuai fungsinya.',
            'Alat kebersihan disimpan dengan baik dan pada tempatnya.',
            'Penempatan APD tertata rapi sesuai dengan tempat penyimpanannya.',
            'Selang Udara dan selang gas tertata rapi.',
        ]);

        $this->seedKriteria('Workshop/Gudang', 'Resik', [
            'Kotoran/sampah dibuang pada tempatnya.',
            'Tidak ada sumber kotor (Debu, Air, Jamur dan sarang laba-laba).',
            'Cat dinding, lantai terang dan bersih, serta layout area terlihat jelas.',
            'Tempat kerja/ruangan, workshop/gudang bagian atas dalam kondisi bersih.',
            'Tools, APAR, mesin dan peralatan kerja terpelihara dengan baik dan dalam kondisi bersih.',
            'Label, identitas mesin, warning sign terlihat jelas dan tidak kotor.',
            'Tidak ada tumpahan dan ceceran minyak, oli, cat, dll, di lantai, fasilitas kerja dan alat kerja.',
            'Papan informasi terlihat jelas, dalam kondisi bersih dan tidak terhalang/tumpang tindih.',
        ]);

        $this->seedKriteria('Workshop/Gudang', 'Rawat', [
            'Lokasi penempatan material/spare part sesuai dengan ketentuan, identitas, label jelas dan ada standar penyimpanan atau penumpukan.',
            'Terdapat jadwal inspeksi/maintenance mesin, perawatan peralatan, serta pemeriksaan secara rutin forklift.',
            'Alat kebersihan, spill kit, dan alat keselamatan terawat dengan baik, serta penempatan yang sesuai.',
            'Terdapat daftar inventaris barang (alat kerja, apd, spare part, dll) beserta jumlahnya, serta penempatan yang sesuai.',
            'Terdapat denah evakuasi serta jadwal, standar dan checklist kebersihan ruangan, toilet, dll.',
            'Terdapat papan informasi 5R yang selalu up to date.',
        ]);

        $this->seedKriteria('Workshop/Gudang', 'Rajin', [
            'Personel di area kerja secara rutin dan aktif menjalankan program 5R, 5 menit sebelum memulai bekerja dan 5 menit sebelum selesai bekerja.',
            'Mereview prosedur peralatan kerja secara rutin.',
            'Jadwal inspeksi/maintenance mesin, perawatan peralatan, serta pemeriksaan secara rutin forklift terealisasi sesuai rencana.',
            'Prosedur/ketentuan pengendalian barang (alat kerja, apd, spare part, dll) telah dipatuhi sebagai upaya minimalisasi jumlah.',
            'Selalu dilakukan pelatihan jika terdapat proses parameter setting mesin, standar preventive, prosedur operasi mesin, yang baru.',
            'Informasi 5R secara rutin diperbarui dengan ide-ide Kaizen, termasuk hasil pemeriksaan patroli, tinjauan manajemen, dan audit internal maupun eksternal.',
            'Area kerja selalu bersih, rapi dan memenuhi estetika setiap sebelum dimulai kerja.',
            'Terdapat tanaman hijau yang tumbuh terawat, disiram dan bersih di area kerja.',
        ]);

        // Kriteria untuk lokasi Kantor
        $this->seedKriteria('Kantor', 'Ringkas', [
            'Tidak ada barang/peralatan kantor yang tidak diperlukan berada di area kerja.',
            'Tidak ada barang cacat atau rusak di area kerja (fax, komputer, dll).',
            'Alat kerja (Tools, ATK, Perangkat IT) dikelola dengan baik dalam satu tempat/lokasi/area.',
            'Tidak ada file/arsip, dll yang sudah kadaluarsa di lemari, filing cabinet/rak tempat arsip.',
            'Penggunaan kertas sudah seminimal mungkin.',
        ]);

        $this->seedKriteria('Kantor', 'Rapi', [
            'Peletakan dan penempatan barang untuk status/kriteria/jenis dan fungsinya sesuai daftar inventaris.',
            'Item barang/perlengkapan/peralatan tersedia dan tertata rapi sesuai tempatnya dalam denah area 5R.',
            'Ada standarisasi pengarsipan.',
            'Ada tanda batas/pengecatan batas penyimpanan (Almari, Meja, Tools, ATK dsb).',
            'Kabel-kabel tertata dengan rapi.',
            'Ada papan pengumuman yang bersih dan rapi.',
        ]);

        $this->seedKriteria('Kantor', 'Resik', [
            'Tidak ada sampah/bekas makanan dan minuman di area kerja.',
            'Tidak ada sumber kotor (Debu, Air, sarang laba-laba dan Jamur).',
            'Tidak ada kebocoran instalasi air dan listrik.',
            'Tidak ada tumpahan dan ceceran minyak di lantai, fasilitas kerja dan alat kerja.',
            'Cat dinding terang & bersih (tidak ada coretan).',
        ]);

        $this->seedKriteria('Kantor', 'Rawat', [
            'Adanya standar perawatan dan kebersihan (Ruang kerja, ruang meeting, toilet, kantin, dll).',
            'Terdapat jadwal rutin untuk kebersihan dan perawatan peralatan kantor, sehingga peralatan selalu dalam kondisi siap digunakan.',
            'Terdapat jadwal rutin untuk pembuangan dan pembersihan tempat sampah.',
            'Tools dan peralatan kerja terawat dengan baik serta penempatan yang sesuai.',
            'Terdapat papan informasi 5R yang selalu up to date.',
            'Adanya jadwal rutin untuk kebersihan lantai, dinding, pintu, lampu, dll.',
            'Adanya pelaporan pelaksanaan 5R (pelaksanaan 5R terdokumentasi dengan baik).',
            'Adanya petunjuk pelaksanaan 5R, penilaian 5R dan checklist 5R.',
            'Pelaksanaan 5R dilakukan oleh setiap karyawan, manajemen dan seluruh pekerja di area kerja.',
        ]);

        $this->seedKriteria('Kantor', 'Rajin', [
            'Personel di area kerja secara rutin dan aktif menjalankan program 5R, 5 menit sebelum memulai bekerja dan 5 menit sebelum selesai bekerja.',
            'Adanya petugas yang mengatur jadwal ruang meeting dan pelaksanaan inspeksi 5R sesuai ketentuan.',
            'Adanya prosedur peminjaman dan pengembalian dokumen/file, barang/peralatan kerja dan prosedur 5R.',
            'Karyawan menggunakan perlengkapan kerja sesuai dengan ketentuan yang ditentukan.',
            'Informasi 5R secara rutin diperbarui dengan ide-ide Kaizen, termasuk hasil pemeriksaan patroli, tinjauan manajemen, dan audit internal maupun eksternal.',
            'Terdapat tanaman dan pepohonan hijau yang tumbuh terawat, disiram dan bersih.',
            'Adanya inspeksi kegiatan 5R secara periodik dan terdokumentasi.',
            'Area kerja selalu bersih, rapi, terawat sebelum dan sesudah jam kerja.',
        ]);
    }

    private function seedKriteria(string $lokasi, string $jenisKriteria, array $kriterias)
    {
        // Ambil id_lokasi berdasarkan nama lokasi
        $lokasiObj = Location::whereLocationName($lokasi)->first();
        if (!$lokasiObj) return; 

        foreach ($kriterias as $kriteria) {
            Criteria::create([
                'location_id' => $lokasiObj->id, 
                'criteria_name' => $kriteria,
                'criteria_type' => $jenisKriteria,
            ]);
        }
    }
}
