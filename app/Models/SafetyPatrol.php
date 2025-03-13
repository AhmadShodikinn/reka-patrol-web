<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyPatrol extends Model
{
    use HasFactory;

    protected $table = 'safety_patrol';

    protected $fillable = [
        'worker_id', 
        'PIC_id', 
        'temuan_path', 
        'deskripsi_temuan',
        'lokasi', 
        'kategori', 
        'resiko', 
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
        return $this->belongsTo(Position::class, 'PIC_id');
    }
}
