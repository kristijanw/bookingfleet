<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasUuids;
    use Notifiable;

    protected $fillable = [
        'title',
        'email',
        'phone',
        'coupon',
        'total_price',
        'trip_day',
        'start_time',
        'location',
        'count_adults',
        'count_children',
        'count_children_under',
        'adult_eat',
        'children_eat',
        'children_price',
        'skipper',
        'skipper_price',
        'status',
    ];

    protected $casts = [
        'status' =>  OrderStatus::class,
        'total_price' => 'float',
        'adult_eat' => 'array',
        'children_eat' => 'array',
    ];
}
