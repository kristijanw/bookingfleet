<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ExcursionDateTime extends Model
{
    protected $fillable = [
        'time',
        'available_seats',
        'excursion_date_id',
    ];

    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = Carbon::parse($value)->format('H:i');
    }

    public function excursionDate()
    {
        return $this->belongsTo(ExcursionDate::class);
    }
}
