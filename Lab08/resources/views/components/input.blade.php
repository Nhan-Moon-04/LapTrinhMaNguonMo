@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => old($name),
    'placeholder' => null,
    'required' => false,
    'min' => null,
    'step' => null,
])
<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if(!is_null($min)) min="{{ $min }}" @endif
        @if(!is_null($step)) step="{{ $step }}" @endif
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
