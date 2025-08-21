<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::recent()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertiesData =
            [
                [
                    'title' => 'Appartement lumineux',
                    'description' => 'Bel appartement avec vue sur parc',
                    'surface' => 75,
                    'price' => 350000,
                    'city' => 'Paris',
                    'bedrooms' => 2,
                    'rooms' => 3,
                    'floor' => 3,
                    'postal_code' => '75001',
                    'sold' => true,
                    'address' => '123 Avenue des Champs-Élysées',
                ],
                [
                    'title' => 'Maison de campagne',
                    'description' => 'Maison spacieuse avec grand jardin',
                    'surface' => 150,
                    'price' => 275000,
                    'city' => 'Toulouse',
                    'bedrooms' => 4,
                    'rooms' => 6,
                    'floor' => 0,
                    'postal_code' => '31000',
                    'sold' => false,
                    'address' => '456 Chemin des Fleurs',
                ],
                [
                    'title' => 'Loft moderne',
                    'description' => 'Loft industriel rénové',
                    'surface' => 90,
                    'price' => 420000,
                    'city' => 'Lyon',
                    'bedrooms' => 2,
                    'rooms' => 3,
                    'floor' => 1,
                    'postal_code' => '69001',
                    'sold' => false,
                    'address' => '123 Rue de la République',
                ],

                [
                    'title' => 'Studio cosy',
                    'description' => 'Petit studio idéal pour étudiant',
                    'surface' => 30,
                    'price' => 150000,
                    'city' => 'Marseille',
                    'bedrooms' => 1,
                    'rooms' => 1,
                    'floor' => 2,
                    'postal_code' => '13001',
                    'sold' => true,
                    'address' => '789 Boulevard de la Liberté',
                ],
                [
                    'title' => 'Belle maison de ville',
                    'description' => 'Magnifique maison avec jardin, idéale pour famille',
                    'surface' => 120,
                    'bedrooms' => 3,
                    'rooms' => 5,
                    'floor' => 2,
                    'price' => 250000,
                    'city' => 'Paris',
                    'address' => '15 Rue de Rivoli',
                    'postal_code' => '75004',
                    'sold' => false,
                ]
            ];
        $randomIndex = array_rand($propertiesData);

        $randomProperty = $propertiesData[$randomIndex];
        $property = new Property();
        $property->fill($randomProperty);

        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $data['image']->store('properties', 'public');
        }

        $property = Property::create($data);

        if ($request->hasFile('images')) {
            $this->uploadImages($request->file('images'), $property);
        }
        $property->options()->sync($request->input('options', []));
        return to_route('admin.property.index')->with('success', 'Le bien a été bien enregistré.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $data = $request->validated();
        $imagePath = null;
        if (array_key_exists('image', $data)) {
            $imagePath = $this->uploadImage($data['image']);
        }
        if ($imagePath || $request->get('delete_image') == '1') {
            if ($property->image && Storage::disk('public')->exists($property->image)) {
                Storage::disk('public')->delete($property->image);
            }
            $data['image'] = $imagePath;
        }
        if ($request->hasFile('images') || $request->deleted_images) {
            try {
                $this->uploadImages(  $request->file('images'), $property, true, $request->deleted_images );
            } catch (\Exception $e) {
                return back()->with('error', 'Erreur lors du traitement des images');
            }
        }

        $property->update($data);

        $property->options()->sync($request->input('options', []));

        return to_route('admin.property.index')->with('success', 'Le bien a été bien modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Le bien a été bien supprimé.');
    }

    private function uploadImage(UploadedFile $image): ?string
    {
        if ($image && !$image->getError()) {
            return $image->store('properties', 'public');
        }
        return null;
    }
    private function uploadImages(?array $images, Property $property, bool $isUpdate = false, ?string $imageRemoves = null ): void {
       if($images){ 
            foreach ($images as $image) {
                try {
                    if (!$image->isValid()) {
                        throw new \Exception("Le fichier {$image->getClientOriginalName()} est invalide");
                    }

                    $path = $image->store('properties', 'public');

                    $thumbnailPath = null;
                    try {

                        $thumbnailPath = "properties/thumbs/{$image->hashName()}";
                    } catch (\Exception $e) {
                        Log::error("Erreur création miniature : " . $e->getMessage());
                    }

                    $property->images()->create([
                        'path' => $path,
                        'thumbnail_path' => $thumbnailPath,
                        'order' => $property->images()->count() + 1
                    ]);
                } catch (\Exception $e) {
                    Log::error("Erreur upload image {$image->getClientOriginalName()} : " . $e->getMessage());
                    continue; 
                }
            }
        }
        if ($isUpdate && $imageRemoves) {
            try {
                $idsToDelete = array_filter(explode(',', $imageRemoves));

                if (empty($idsToDelete)) {
                    return;
                }

                $imagesToDelete = $property->images()
                    ->whereIn('id', $idsToDelete)
                    ->get(['id', 'path', 'thumbnail_path']);

                $deletedIds = [];
                foreach ($imagesToDelete as $image) {
                    try {
                        if (Storage::disk('public')->exists($image->path)) {
                            Storage::disk('public')->delete($image->path);
                        }

                        if ($image->thumbnail_path && Storage::disk('public')->exists($image->thumbnail_path)) {
                            Storage::disk('public')->delete($image->thumbnail_path);
                        }

                        $deletedIds[] = $image->id;
                    } catch (\Exception $e) {
                        Log::error("Erreur suppression fichier image ID {$image->id} : " . $e->getMessage());
                        continue;
                    }
                }

                if (!empty($deletedIds)) {
                    $property->images()->whereIn('id', $deletedIds)->delete();
                }
            } catch (\Exception $e) {
                Log::error("Erreur globale suppression images : " . $e->getMessage());
                throw $e; 
            }
        }
    }
}
