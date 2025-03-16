<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafetyPatrolRecap extends Model
{
    protected $fillable = [
        'number',
        'issued_date',
        'from_date',
        'to_date',
        'description'
    ];
}
