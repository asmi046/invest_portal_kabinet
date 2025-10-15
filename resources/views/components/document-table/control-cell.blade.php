<a href="{{ $documentType->index_url."/print/".$item->id }}">Печатная форма</a>
@if ($signed || $signed_local)
    <a href="{{ $documentType->index_url."/edit/".$item->id }}">Посмотреть</a>
@else
    <a href="{{ $documentType->index_url."/edit/".$item->id }}">Редактировать</a>
@endif

@if ($item->validate && !$signed && !$signed_local)
    <a href="{{ $documentType->index_url."/sign/".$item->id }}">Подписать</a>
@endif
{{-- <a href="{{ $documentType->index_url."/status/".$item->id }}">Статус</a> --}}
