<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
     $query = Property::query()->with('options');
    
    switch($request->get('sort', 'newest')) {
        case 'price_asc':
            $query->orderBy('price');
            break;
        case 'price_desc':
            $query->orderByDesc('price');
            break;
        case 'surface_asc':
            $query->orderBy('surface');
            break;
        case 'surface_desc':
            $query->orderByDesc('surface');
            break;
        default:
            $query->latest();
    }
    
    $properties = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('properties.index', [
            'properties' => $properties,
        ]);
    }

    public function show(Property $property)
    {
        return view('properties.show', [
            'property' => $property,
            'similarProperties' => Property::where('id', '!=', $property->id)
                ->where('city', $property->city)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get(),
        ]);
    }

    public function contact(PropertyContactRequest $request, Property $property)
    {
        Mail::to('diallo@gmail.com')->send(new PropertyContactMail($property, $request->validated()));
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
