<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcursionDateTime extends Model
{
    protected $fillable = [
        'time',
        'available_seats',
        'excursion_date_id',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function excursionDate()
    {
        return $this->belongsTo(ExcursionDate::class);
    }
}
