<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'id_position', 
        'NIP', 
        'fullname', 
        'email', 
        'password'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position');
    }

}
