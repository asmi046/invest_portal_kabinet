@if ($item->state === "Предоставлен ответ")
<div class="organization_report">
    <h3>По вашемо обращению получен ответ:</h3>
    {!! $item->report !!}
</div>
@endif
