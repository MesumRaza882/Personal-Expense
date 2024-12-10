@props([
    'label' => null,
    'name' => 'test',
    'type' => 'text', // Default type is 'text'
    'value' => null,
    'required' => false,
    'extraClass' => '',
    'placeholder' => null,
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control {{ $extraClass }}" 
        value="{{ old($name, $value) }}" 
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }} {{ $attributes }} />
    
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
