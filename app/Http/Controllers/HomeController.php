<?php

namespace App\Http\Controllers;

use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::available(true)->recent()->limit(6)->get();
        return view('home', [
            'properties' => $properties,
        ]);
    }
}
