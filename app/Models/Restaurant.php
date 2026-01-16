<?php

namespace App\Models;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $fillable = [
        'order',
        'name_ar',
        'name_en',
        'type_ar',
        'type_en',
        'delivery_time_ar',
        'delivery_time_en',
        'working_hours_ar',
        'working_hours_en',
        'image_path',
        'keywords_ar',
        'keywords_en',
        'description_ar',
        'description_en',
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
