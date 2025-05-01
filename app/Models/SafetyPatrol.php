<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SafetyPatrol extends Model
{
    protected $fillable = [
        'worker_id', 
        'pic_id',
        'location', 
        'category', 
        'risk', 
        'checkup_date',
        'action_path', 
        'action_description'
    ];

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function pic(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function findings(): MorphMany
    {
        return $this->morphMany(Finding::class, 'findable');
    }
}
