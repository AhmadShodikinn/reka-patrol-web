<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    protected $fillable = [
        'worker_id', 
        'pic_id', 
        'criteria_id',
        'inspection_location', 
        'value', 
        'suitability', 
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

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function findings(): HasMany
    {
        return $this->hasMany(Finding::class);
    }
}
