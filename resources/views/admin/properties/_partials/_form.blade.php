<form action="{{ route($isPropertyExists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post" enctype="multipart/form-data">
  @csrf
@method($isPropertyExists ? 'put' : 'post')

    <div class="row">
        <div class="col-md-6">
            @include('components.input', [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Titre',
                'required' => true,
                'placeholder' => 'Entrez le titre du bien',
                'value' => $property->title ?? ''
            ])
        </div>
        <div class="col-md-6 row">
            @include('components.input', [
                'name' => 'price',
                'type' => 'text',
                'label' => 'Prix',
                'required' => true,
                'wrapperClass' => 'col',
                'placeholder' => 'Entrez le prix en GNF',
                'value' => $property->price ?? ''
            ])
            @include('components.input', [
                'name' => 'surface',
                'type' => 'text',
                'label' => 'Surface (m²)',
                'required' => true,
                'wrapperClass' => 'col',
                'placeholder' => 'Entrez la surface en m²',
                'value' => $property->surface ?? ''
            ])
        </div>
        @include('components.input', [
            'name' => 'rooms',
            'type' => 'text',
            'label' => 'Pièces',
            'required' => true,
            'value' => $property->rooms ?? '',
            'wrapperClass' => 'col-md-4'
        ])
        @include('components.input', [
            'name' => 'bedrooms',
            'type' => 'text',
            'label' => 'Chambres',
            'required' => true,
            'value' => $property->bedrooms ?? '',
            'wrapperClass' => 'col-md-4'
        ])
        @include('components.input', [
            'name' => 'floor',
            'type' => 'text',
            'label' => 'Étage',
            'required' => true,
            'value' => $property->bedrooms ?? '',
            'wrapperClass' => 'col-md-4'
        ])

        @include('components.input', ['name' => 'city',
            'type' => 'text',
            'label' => 'Ville',
            'required' => true,
            'placeholder' => 'Entrez la ville',
            'wrapperClass' => 'col-md-4',
            'value' => $property->city ?? '',
        ])
        @include('components.input', [
            'name' => 'address',
            'type' => 'text',
            'label' => 'Adresse',
            'required' => true,
            'placeholder' => 'Entrez l\'adresse complète',
            'wrapperClass' => 'col-md-4',
            'value' => $property->address ?? ''
        ])
        @include('components.input', [
            'name' => 'postal_code',
            'type' => 'text',
            'label' => 'Code postal',
            'required' => true,
            'wrapperClass' => 'col-md-4',
            'placeholder' => 'Entrez le code postal',
            'value' => $property->postal_code ?? ''
        ])

        @include('components.switch', [
            'name' => 'sold',
            'label' => 'Vendu',
            'checked' => $property->sold ?? false
        ])
        @php
        @endphp
        @include('components.select', [
            'name' => 'options',
            'label' => 'Options',
            'options' => $options->pluck('name', 'id')->all(),
            'selected' => $property->options->pluck('id')->toArray(),
            'multiple' => true
        ])
        
        @include('components.textarea', [
            'name' => 'description',
            'label' => 'Description',
            'required' => false,
            'rows' => 5,
            'wrapperClass' => 'col-md-12',
            'placeholder' => 'Entrez une description détaillée du bien',
            'value' => $property->description ?? ''
        ])
        @include('components.input', [
            'name' => 'image',
            'type' => 'file',
            'label' => 'Image principal du bien',
            'required' => false,
            'placeholder' => 'Télécharger une image du bien',
            'value' => $property->image ?? ''
        ])
    </div>

    <!-- Affichage de l'image existante -->
    @if($isPropertyExists && $property->image)
    <div class="mt-4">
        <label class="form-label">Image actuelle</label>
        <div class="border p-3 rounded" style="max-width: 400px;">
            <img src="{{ asset('storage/' . $property->image) }}" 
                alt="Image actuelle du bien" 
                class="img-fluid rounded current-image"
                style="max-height: 200px; transition: opacity 0.5s ease;">
            <div class="mt-2">
                <a href="{{ asset('storage/' . $property->image) }}" 
                target="_blank" 
                class="btn btn-sm btn-outline-primary me-2">
                <i class="bi bi-eye"></i> Voir en grand
                </a>
                <button type="button" 
                        class="btn btn-sm btn-outline-danger delete-image-btn" 
                        onclick="confirmDelete()">
                <i class="bi bi-trash"></i> Supprimer
                </button>
                <input type="hidden" name="delete_image" id="delete-image" value="0">
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Images du bien</h5>
                    
                    <!-- Champ d'upload multiple -->
                    <div class="mb-3">
                        <label for="images" class="form-label">Ajouter des images</label>
                        <input type="file" 
                               class="form-control" 
                               id="images" 
                               name="images[]" 
                               multiple 
                               accept="image/*">
                        <div class="form-text">Sélectionnez une ou plusieurs images (JPEG, PNG, max 2MB chacune)</div>
                    </div>
                    
                    <!-- Zone de prévisualisation -->
                    <div class="preview-container d-flex flex-wrap gap-3 mb-3" id="previewContainer">
                        @if($isPropertyExists && $property->images->count() > 0)
                            @foreach($property->images as $image)
                            <div class="preview-item position-relative" data-id="{{ $image->id }}">
                                <img src="{{ asset('storage/' . $image->path) }}" 
                                     class="img-thumbnail" 
                                     style="width: 150px; height: 100px; object-fit: cover;">
                                <button type="button" 
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image"
                                        data-id="{{ $image->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                            </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Input caché pour les images à supprimer -->
                    <input type="hidden" name="deleted_images" id="deletedImages" value="">
                </div>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary m">{{ $isPropertyExists ? 'Modifier la propriété' : 'Créer' }}</button>
</form>

@section('scripts')
<script>
    // Prévisualisation des nouvelles images
    document.getElementById('images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('previewContainer');
        
        for (const file of e.target.files) {
            if (!file.type.match('image.*')) continue;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item position-relative';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" 
                         class="img-thumbnail" 
                         style="width: 150px; height: 100px; object-fit: cover;">
                    <button type="button" 
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-preview">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
                previewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        }
    });

    // Gestion de la suppression des images
    document.addEventListener('click', function(e) {
        // Suppression des prévisualisations
        if (e.target.closest('.remove-preview')) {
            e.target.closest('.preview-item').remove();
        }
        
        // Suppression des images existantes
        if (e.target.closest('.delete-image')) {
            const imageId = e.target.closest('.delete-image').dataset.id;
            const deletedInput = document.getElementById('deletedImages');
            const deletedIds = deletedInput.value ? deletedInput.value.split(',') : [];
            
            if (!deletedIds.includes(imageId)) {
                deletedIds.push(imageId);
                deletedInput.value = deletedIds.join(',');
                e.target.closest('.preview-item').style.opacity = '0.5';
            }
        }
    });
</script>

<script>
    function confirmDelete() {
        if(confirm('Supprimer cette image ?')) {

            const image = document.querySelector('.current-image');
            image.style.opacity = '0.5';
            

            document.getElementById('delete-image').value = '1';
            

            const deleteBtn = document.querySelector('.delete-image-btn');
            deleteBtn.disabled = true;
            deleteBtn.classList.add('disabled');
        }
    }
</script>
@endsection

@section('styles')
<style>
    .preview-container {
        min-height: 120px;
        padding: 10px;
        border: 1px dashed #ccc;
        border-radius: 5px;
    }
    
    .preview-item {
        transition: all 0.3s ease;
    }
    
    .preview-item:hover {
        transform: scale(1.05);
    }
</style>
@endsection