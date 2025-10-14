@if (isset($item) && !$item->editable)
    <div class="form-control-panel">
        <a href="{{ $documentType->index_url.'/print/'.$item->id }}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
    </div>
@endif
