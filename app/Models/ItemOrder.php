<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemOrder extends Model
{
    protected $fillable = [
        'title',
        'trip_day',
        'start_time',
        'location',
        'order_id',
    ];

    protected $casts = [
        'trip_day' =>  'date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
