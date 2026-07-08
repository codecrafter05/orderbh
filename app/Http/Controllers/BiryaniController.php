<?php

namespace App\Http\Controllers;

use App\Models\BiryaniDish;

class BiryaniController extends Controller
{
    public function index()
    {
        $dishes = BiryaniDish::orderBy('order')->orderBy('id')->get();

        return view('biryani', [
            'dishes' => $dishes,
        ]);
    }
}
