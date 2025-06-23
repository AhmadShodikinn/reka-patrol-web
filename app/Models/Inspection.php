<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Inspection extends Model
{
    protected $fillable = [
        'worker_id', 
        'pic_id', 
        'findings_description',
        'criteria_id',
        'inspection_location', 
        'is_valid_entry',
        'memo_id',
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

    public function findings(): MorphMany
    {
        return $this->morphMany(Finding::class, 'findable');
    }

    public function memo(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'memo_id');
    }

    public function hasMemo(): bool
    {
        return $this->memo()->exists();
    }
}
