@props([
    'name' => "name",
    'label' => "Поле",
    'value' => "",
    'required' => true,
    'list' => [
        'элемент 1' => '1',
        'элемент 2' => '2',
    ]
])

<label class="form-elem">
    <span class="form-elem__caption">
         {{ $label }}
        @if ($required)
            <sup>*</sup>
        @endif
    </span>
    <select name="{{ $name }}" class="select-ch select-ch--no-search" id="">
        <option value="" disabled selected>Выберите значение</option>

        @foreach ($list as $item => $val)
            <option @selected($value === $val) value="{{ $val}}">{{ $item }}</option>
        @endforeach

    </select>
    @error($name)
        <span class="form-elem__error-message">{{ $message }}</span>
    @enderror
</label>
