<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    protected $fillable = [
        'restaurant_id',
        'order',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image_path',
        'prices',
    ];

    protected $casts = [
        'prices' => 'array',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
