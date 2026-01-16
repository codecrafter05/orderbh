<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZohoorDish extends Model
{
    protected $fillable = [
        'category_id',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
