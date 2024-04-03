<form class="form-project-submission flex-form" method="POST" action="{{ ( isset($action) )?$action:"#"  }}">
    @csrf
    @if (session('drafr_save'))
        <p class="success">{{ session('drafr_save') }}</p>
    @endif

    <input type="hidden" name="item_id" value="{{ $item->id ?? 0 }}">

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Ф.И.О. заявителя<span class="required">*</span>
            </span>
            <input type="text" name="name" class="form-elem__field"  value="{{ $item->name ?? '' }}">
            @error('name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Организация<span class="required">*</span>
            </span>
            <input type="text" name="organization" class="form-elem__field"  value="{{ $item->organization ?? '' }}">
            @error('organization')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Должность<span class="required">*</span>
            </span>
            <input type="text" name="dolgnost" class="form-elem__field"  value="{{ $item->dolgnost ?? '' }}">
            @error('dolgnost')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Телефон<span class="required">*</span>
            </span>
            <input type="text" name="phone" class="form-elem__field tel-mask"  value="{{ $item->phone ?? '' }}">
            @error('phone')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <h3>Информациф об объекте</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Наименование объекта<span class="required">*</span>
        </span>
        <input type="text" name="object_name" class="form-elem__field"  value="{{ $item->object_name ?? '' }}">
        @error('object_name')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Тип объекта<span class="required">*</span>
        </span>
        <select name="object_type" class="form-elem__field" id="">
            <option value="" disabled selected>Выберите тип проекта</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Масштабный инвестиционный проект')) value="Масштабный инвестиционный проект">Масштабный инвестиционный проект</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Социально-культурного назначения')) value="Социально-культурного назначения">Социально-культурного назначения</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Коммунально-бфтового назначения')) value="Коммунально-бытового назначения">Коммунально-бытового назначения</option>
        </select>

        @error('object_type')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Приложения</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Страниц в приложении<span class="required">*</span>
        </span>
        <input type="number" name="prilogenie_list_count" class="form-elem__field"  value="{{ $item->prilogenie_list_count ?? '' }}">
        @error('prilogenie_list_count')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>


    <div class="form-control-panel">
        @if ($format == "create")
            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить черновик</button>
        @else
            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
            <button type="submit" class="btn" title="Проверить и подписать" name="action" value="validate_signe"> <span class="save-icon"></span>Проверить и подписать</button>
            <a
            class="btn"
            onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
            href="{{ route('technical_connect_delete', $item->id) }}"
            >Удалить</a>
        @endif

    </div>

</form>
