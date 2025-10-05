@props([
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
    <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="{{ $name }}">{{ $value }}</textarea>
    @error($name)
        <span class="form-elem__error-message">{{ $message }}</span>
    @enderror
</label>
