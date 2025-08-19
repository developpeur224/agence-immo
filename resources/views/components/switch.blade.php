@php
    // Paramètres avec valeurs par défaut
    $name = $name ?? '';
    $label = $label ?? ucfirst($name);
    $value = $value ?? 1;
    $checked = $checked ?? old($name, false);
    $required = $required ?? false;
    $disabled = $disabled ?? false;
    $helpText = $helpText ?? null;
    $wrapperClass = $wrapperClass ?? 'mb-3';
    $inline = $inline ?? false;
    $size = $size ?? ''; // 'lg' pour large
@endphp

<div @class([$wrapperClass, 'form-group', 'form-switch', $size ? "form-switch-$size" : '', $inline ? 'd-flex align-items-center' : ''])>
    <input
        type="checkbox"
        class="form-check-input"
        role="switch"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
    >

    @if($label)
        <label for="{{ $name }}" class="form-check-label ms-2">
            {{ $label }}
            @if($required)<span class="text-danger ms-1">*</span>@endif
        </label>
    @endif

    @if($helpText)
        <div class="form-text text-muted small @if($inline) ms-3 @endif">{{ $helpText }}</div>
    @endif

    @error($name)
        <div class="invalid-feedback d-block">
            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
        </div>
    @enderror
</div>