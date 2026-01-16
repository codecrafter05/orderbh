<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['dishes' => function ($query) {
            $query->orderBy('order')->orderBy('id');
        }])->orderBy('order')->orderBy('id')->get();

        return view('menu', [
            'restaurants' => $restaurants,
        ]);
    }

    public function show($slug)
    {
        // Find restaurant by slug (convert name_en to slug for comparison)
        $restaurants = Restaurant::with(['dishes' => function ($query) {
            $query->orderBy('order')->orderBy('id');
        }])->orderBy('order')->orderBy('id')->get();

        // Find the restaurant that matches the slug
        $selectedRestaurant = $restaurants->first(function ($restaurant) use ($slug) {
            return Str::slug($restaurant->name_en) === $slug || Str::slug($restaurant->name_ar) === $slug;
        });

        if (!$selectedRestaurant) {
            abort(404, 'Restaurant not found');
        }

        return view('menu', [
            'restaurants' => $restaurants,
            'selectedRestaurant' => $selectedRestaurant,
        ]);
    }
}
