<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('order')->orderBy('id')->get();

        return view('restaurants', [
            'restaurants' => $restaurants,
        ]);
    }
}
