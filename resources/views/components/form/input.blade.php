@props([
    'type' => "text",
    'name' => "name",
    'label' => "Поле",
    'value' => "",
    'required' => true,
])

<label class="form-elem">
    <span class="form-elem__caption">
        {{ $label }}
        @if ($required)
            <sup>*</sup>
        @endif
    </span>
    <input type="{{ $type }}" name="{{ $name }}" class="form-elem__field"  value="{{ $value }}">
    @error($name)
        <span class="form-elem__error-message">{{ $message }}</span>
    @enderror
</label>
