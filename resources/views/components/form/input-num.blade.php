@props([
    'type' => "number",
    'name' => "name",
    'label' => "Поле",
    'value' => 0,
    'required' => true,
    'step' => 1,
    'min' => 0,
    'max' => 99999999.99
])

<label class="form-elem">
    <span class="form-elem__caption">
        {{ $label }}
        @if ($required)
            <sup>*</sup>
        @endif
    </span>
    <input type="{{ $type }}" name="{{ $name }}" class="form-elem__field" step="{{ $step }}" min="{{ $min }}" max="{{ $max }}" value="{{ $value }}">
    @error($name)
        <span class="form-elem__error-message">{{ $message }}</span>
    @enderror
</label>
