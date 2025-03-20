<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExcursionTime extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'capacity',
        'excursion_id',
    ];

    protected $casts = [
        'date' => 'string',
        'start_time' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }

    public function excursion(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }
}
