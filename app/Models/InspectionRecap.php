<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionRecap extends Model
{
    protected $fillable = [
        'number',
        'issued_date',
        'from_date',
        'to_date',
        'description'
    ];
}
