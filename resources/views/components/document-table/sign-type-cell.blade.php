@if (!isset($item->goskeyRegistries[0]))
-
@elseif (isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->is_ul == true)
    Юридическое лицо
@else
    Физическое лицо
@endif
