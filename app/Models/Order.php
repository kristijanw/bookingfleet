<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasUuids;
    use Notifiable;

    protected $fillable = [
        'coupon',
        'total_price',
        'status',
    ];

    protected $casts = [
        'status' =>  OrderStatus::class,
        'total_price' => 'float'
    ];

    public function itemOrders(): HasMany
    {
        return $this->hasMany(ItemOrder::class);
    }
}
