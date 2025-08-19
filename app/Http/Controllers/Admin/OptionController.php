<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionFormRequest;
use App\Models\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.options.index', [
            'options' =>Option::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       /* $options = [
        'Piscine', 'Parking', 'Jardin', 'Ascenseur', 'Climatisation',
        'Chauffage central', 'Cuisine équipée', 'Terrasse', 'Balcon', 
        'Système d\'alarme'
        ];
        foreach ($options as $key => $value) {
            Option::created(['name' => $value]);
        }*/
        return view('admin.options.form', [
            'option' => new Option(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionFormRequest $request)
    {

        Option::create($request->validated());
        return to_route('admin.option.index')->with('success', 'L\'option a été bien enregistré.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.form', [
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionFormRequest $request, Option $option)
    {
        $option->update($request->validated());
        return to_route('admin.option.index')->with('success', 'L\'option a été bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return to_route('admin.option.index')->with('success', 'L\'option a été bien supprimé.');
    }
}
