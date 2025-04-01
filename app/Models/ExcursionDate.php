<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExcursionDate extends Model
{
    protected $fillable = [
        'date',
        'excursion_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function excursion(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }

    public function excursionDateTimes(): HasMany
    {
        return $this->hasMany(ExcursionDateTime::class);
    }
}
