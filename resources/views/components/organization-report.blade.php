@if ($item->state === "Предоставлен ответ")
    <div class="form-status form-status--success">
        <h3>По вашемо обращению получен ответ:</h3>
        {!! $item->report !!}
    </div>
@endif
