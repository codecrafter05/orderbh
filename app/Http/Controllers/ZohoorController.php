<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ZohoorDish;

class ZohoorController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->orderBy('id')->get();
        $dishes = ZohoorDish::with('category')->orderBy('order')->orderBy('id')->get();

        return view('zohoor', [
            'categories' => $categories,
            'dishes' => $dishes,
        ]);
    }
}
