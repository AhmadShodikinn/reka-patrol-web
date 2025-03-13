<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapSafetyPatrol extends Model
{
    use HasFactory;

    protected $table = 'rekap_safety_patrol';

    protected $fillable = [
        'no',
        'Tgl_terbit',
        'Tgl_awal',
        'Tgl_Akhir',
        'Keterangan'
    ];
}
