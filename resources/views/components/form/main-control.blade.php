<x-document-state-panel :item="$item ?? null"></x-document-state-panel>

    @if ($format == "create")
        <div class="form-control-panel">
            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить черновик</button>
        </div>
    @else
        @if (isset($item) && $item->editable)

            <div class="form-control-panel">
                @if ($item->editable)
                    <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
                @endif


                @if (!$item->validated)
                    <button type="submit" class="btn" title="Проверить и подписать" name="action" value="check_draft"> <span class="sing-icon"></span>Проверить</button>
                @endif


                <a href="{{ $documentType->index_url.'/print/'.$item->id }}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>

                @if ($item->validated)
                    <button type="submit" class="btn" title="Отправить" name="action" value="send"> <span class="doccheck-icon"></span>Отправить</button>
                @endif

                @if (!isset($item->goskeyRegistries[0]))
                    <a class="btn mlAuto"
                    onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
                    href="{{ $documentType->index_url.'/delete/'.$item->id }}"
                    ><span class="delete-icon"></span>Удалить</a>
                @endif
            </div>
        @endif

    @endif

