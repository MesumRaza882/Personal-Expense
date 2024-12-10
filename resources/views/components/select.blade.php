@props([
    'label' => null,
    'name' => 'text',
    'options' => [],
    'selected' => null,
    'required' => true,
    'extraClass' => '',
])


<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <select {{ $attributes->merge(['class' => 'form-select ' . $extraClass]) }} id="{{ $name }}"
        name="{{ $name }}" {{ $required ? 'required' : '' }}>
        @if (!$required)
            <option value="">Select {{ $label }}</option>
        @endif

        @foreach ($options as $value => $text)
            @if (is_object($text) && property_exists($text, 'id') && property_exists($text, 'name'))
                <option value="{{ $text->id }}" {{ (string) $selected === (string) $text->id ? 'selected' : '' }}>
                    {{ $text->name }}
                </option>
            @else
                <option value="{{ $value }}" {{ (string) $selected === (string) $value ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endif
        @endforeach
    </select>
    <!-- Error Message Display -->
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
