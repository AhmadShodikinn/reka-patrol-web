<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'inspection';

    protected $fillable = [
        'worker_id', 
        'PIC_id', 
        'kriteria_id', 
        'temuan_path', 
        'deskripsi_temuan',
        'lokasi_inspeksi', 
        'nilai', 
        'kesesuaian', 
        'Tgl_pemeriksaan',
        'tindak_lanjut_path', 
        'deskripsi_tindak_lanjut'
    ];

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'PIC_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
