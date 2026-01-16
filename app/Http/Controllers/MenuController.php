<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

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
}
