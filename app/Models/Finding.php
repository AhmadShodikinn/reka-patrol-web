<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Finding extends Model
{
    protected $fillable = [
        'findable_id',
        'findable_type',
        'image_path',
    ];

    public function findable(): MorphTo
    {
        return $this->morphTo();
    }
}
