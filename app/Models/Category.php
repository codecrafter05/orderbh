<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'order',
        'name_ar',
        'name_en',
        'image_path',
    ];

    public function zohoorDishes(): HasMany
    {
        return $this->hasMany(ZohoorDish::class);
    }
}
