<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criteria extends Model
{
    protected $fillable = [
        'criteria_type',
        'location_id',
        'criteria_name',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
