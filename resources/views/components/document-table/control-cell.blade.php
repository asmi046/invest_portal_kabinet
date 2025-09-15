<a href="{{route($routeName.'_print', $item->id)}}">Печатная форма</a>
@if (
    !in_array($item->state, config('documents')['area_get']['statuses_noedit']) &&
    !isset($item->goskeyRegistries[0])
)
    <a href="{{route($routeName.'_edit', $item->id)}}">Редактировать</a>
@else
    <a href="{{route($routeName.'_edit', $item->id)}}">Посмотреть</a>
@endif
<a href="{{route($routeName.'_status', $item->id)}}">Статус</a>
