<div class="document_satae_panel">
    <div class="state_blk status">Статус документа: {{ $state }}</div>

    <div class="dop_state">
        @if ($validated)
            <div class="state_blk validated"> <span class="icon doccheck-icon"></span> Проверен</div>
        @endif
        @if ($signed)
            <div class="state_blk signed"> <span class="icon sign2-icon"></span> Подписан</div>
        @endif

        @if ($signed_local)
            <div class="state_blk signed_local"> <span class="icon sign2-icon"></span> Подписан (локально)</div>
        @endif
    </div>

</div>
