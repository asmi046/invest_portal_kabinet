<x-document-state-panel :item="$item ?? null"></x-document-state-panel>
<div class="form-control-panel">
    @if ($format == "create")
        <button type="submit" class="btn" title="Сохранить черновик" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить черновик</button>
    @else

        @if (isset($item) && $item->editable)

            @if ($item->editable)
                <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
            @endif

            @if (!$item->validated)
                <button type="submit" class="btn" title="Проверить и подписать" name="action" value="check_draft"> <span class="sing-icon"></span>Проверить</button>
            @endif

            <a href="{{ $documentType->index_url.'/print/'.$item->id }}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
            @if (!isset($item->goskeyRegistries[0]))
                <a class="btn mlAuto"
                onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
                href="{{ $documentType->index_url.'/delete/'.$item->id }}"
                ><span class="delete-icon"></span>Удалить</a>
            @endif


        @else
            <a href="{{ $documentType->index_url.'/print/'.$item->id }}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
        @endif

    @endif
</div>
