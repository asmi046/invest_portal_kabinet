<a href="{{ $documentType->index_url."/print/".$item->id }}">Печатная форма</a>
@if ($item->editable && !isset($item->goskeyRegistries[0]))
    <a href="{{ $documentType->index_url."/edit/".$item->id }}">Редактировать</a>
@else
    <a href="{{ $documentType->index_url."/edit/".$item->id }}">Посмотреть</a>
@endif
<a href="{{ $documentType->index_url."/status/".$item->id }}">Статус</a>
