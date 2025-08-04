@if ($format == "create")
                <div class="form-control-panel">
                    <button type="submit" class="btn" title="Сохранить черновик" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить черновик</button>
                </div>
            @else

                    @if (!in_array($item->state, config('documents')[$doct]['statuses_noedit']))
                        <div class="form-control-panel">
                            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
                            <button type="submit" class="btn" title="Проверить и подписать" name="action" value="send_to_corp"> <span class="sing-icon"></span>Проверить и отправить</button>
                            <a href="{{route('area_get_print', $item->id)}}" class="btn" title="Печатная форма"> <span class="print-form-icon"></span>Печатная форма</a>
                            <a
                            class="btn mlAuto"
                            onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
                            href="{{ route($deleteroat, $item->id) }}"
                            ><span class="delete-icon"></span>Удалить</a>
                        </div>
                    @endif

@endif
