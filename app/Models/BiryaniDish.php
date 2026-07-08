<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiryaniDish extends Model
{
    protected $fillable = [
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
}
