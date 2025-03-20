<?php

namespace App\Models;

use App\Enums\ExcursionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Excursion extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'tooltip_info',
        'price',
        'children_price',
        'header_img',
        'gallery',
        'google_maps_url',
        'departure',
        'boat_capacity',
        'included_in_price',
        'skipper',
        'skipper_price',
        'duration',
        'status',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'status' =>  ExcursionStatus::class,
        'price' => 'float',
        'included_in_price' => 'array',
        'gallery' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function excursionTime(): HasMany
    {
        return $this->hasMany(ExcursionTime::class);
    }
}
