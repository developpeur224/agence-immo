@php
    // Configuration des paramètres avec valeurs par défaut
    $name = $name ?? '';
    $label = $label ?? Str::title(str_replace('_', ' ', $name));
    $options = $options ?? [];
    $selected = $selected ?? old($name, $multiple ? [] : null);
    $multiple = $multiple ?? false;
    $required = $required ?? false;
    $class = $class ?? '';
    $helpText = $helpText ?? '';
    $placeholder = $placeholder ?? ($multiple ? 'Sélectionnez une ou plusieurs options' : 'Sélectionnez une option');
    $allowEmpty = $allowEmpty ?? true;
    $attributes = $attributes ?? [];

    // Conversion des selected en tableau et gestion des collections
    $selectedValues = is_array($selected) ? $selected : 
                     (is_object($selected) && method_exists($selected, 'toArray') ? $selected->toArray() : 
                     (array)$selected);
@endphp

<div class="form-group mb-3 {{ $wrapperClass ?? '' }}">
    @if($label)
        <label for="{{ $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)<span class="text-danger ms-1">*</span>@endif
        </label>
    @endif

    <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
            id="{{ $id ?? $name }}"
            class="form-select {{ $class }} @error($name) is-invalid @enderror"
            @if($multiple) multiple @endif
            @if($required) required @endif
            size="{{ $multiple ? min(8, max(3, count($options))) : null }}"
            @foreach($attributes as $key => $value) {{ $key }}="{{ $value }}" @endforeach>
        
        @if($allowEmpty)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $value => $option)
            <option value="{{ $value }}"
                @if($multiple)
                    {{ in_array($value, $selectedValues) ? 'selected' : '' }}
                @else
                    {{ $value == $selected ? 'selected' : '' }}
                @endif
            >
                {{ is_array($option) ? $option['label'] ?? $option['name'] ?? $value : $option }}
            </option>
        @endforeach
    </select>

    @if($helpText)
        <div class="form-text text-muted small mt-1">
            {{ $helpText }}
            @if($multiple)(Utilisez Ctrl/Cmd pour sélection multiple)@endif
        </div>
    @endif

    @error($name)
        <div class="invalid-feedback d-block">
            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
        </div>
    @enderror
</div>