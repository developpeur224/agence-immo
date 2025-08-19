@php
    // Paramètres avec valeurs par défaut
    $class = $class ?? null;
    $name = $name ?? '';
    $value = $value ?? '';
    $label = $label ?? ucfirst($name);
    $placeholder = $placeholder ?? 'Entrez '.strtolower($label);
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $readonly = $readonly ?? false;
    $helpText = $helpText ?? null;
    $wrapperClass = $wrapperClass ?? '';
    $rows = $rows ?? 3;
@endphp

<div @class([$wrapperClass, 'form-group mb-3'])>
    @if($label)
        <label for="{{ $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <textarea
        class="form-control @error($name) is-invalid @enderror {{ $class }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
    >{{ old($name, $value) }}</textarea>

    @if($helpText)
        <div class="form-text text-muted small">{{ $helpText }}</div>
    @endif

    @error($name)
        <div class="invalid-feedback d-block">
            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
        </div>
    @enderror
</div>