@if (isset($item) && !$item->editable)
    <div class="form-control-panel">
        <a href="{{ $documentType->index_url.'/print/'.$item->id }}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
        <button type="submit" class="btn" title="Отправить" name="action" value="send"> <span class="doccheck-icon"></span>Отправить</button>
    </div>
@endif
