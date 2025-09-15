@if ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->status_code == 100)
    <div @class(['signed_blk'])> <span class="icon sign2-icon"></span> Подписан</div>
@endif

@if ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->error_code == -100)
    <div @class(['signed_blk', 'error_sig'])> <span class="icon sign2-icon"></span>Пользователь отказался от подписания</div>
@elseif  ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->error_code != null)
    <div @class(['signed_blk', 'error_shtat_sig'])> <span class="icon sign2-icon"></span> {{$item->goskeyRegistries[0]->error_message}}</div>
@endif
