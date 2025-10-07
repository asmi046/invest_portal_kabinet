@if (isset($item) && in_array($item->state, config('documents')[$doct]['statuses_noedit']))
    <div class="form-control-panel">
        <a href="{{route($printroute, $item->id)}}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
    </div>
@endif
