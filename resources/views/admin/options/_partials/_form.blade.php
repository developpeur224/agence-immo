<form action="{{ route($isOptionExists ? 'admin.option.update' : 'admin.option.store', $option) }}" method="post">
  @csrf
@method($isOptionExists ? 'put' : 'post')

    <div class="row">
        <div class="col-md-6">
            @include('components.input', [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nom',
                'required' => true,
                'placeholder' => 'Entrez le nom de l\'option',
                'value' => $option->name ?? ''
            ])
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary m">{{ $isOptionExists ? 'Modifier l\'option' : 'Créer' }}</button>
</form>