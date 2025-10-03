@props([
    'name' => "attachment[]",
    'label' => "Поле",
    'format' => "В форматах doc, docx, pdf, jpg, png",
    'value' => "",
    'required' => true,
])

<div class="file-funnel">
    <input type="file" name="{{ $name }}" class="file-funnel__file-input" multiple="multiple">
    <div class="file-funnel__text">
        <span class="file-funnel__caption">
            {{ $label }}
        </span>
        <span class="file-funnel__direction">
            {{ $format }}
        </span>
    </div>
    <div class="file-funnel__receiver">
        +
    </div>
    <div class="file-funnel__docs">
        <button type="button" class="file-funnel-btn file-funnel-btn--reset">Очистить</button>
    </div>
</div>
