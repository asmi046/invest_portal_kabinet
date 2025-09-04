<form enctype='multipart/form-data'
    @class(['form-project-submission', 'flex-form', 'form_disabled' => isset($item->state) && in_array($item->state,
    config('documents')["area_get"]['statuses_noedit'])])
    method="POST"
    @if (isset($item) && $item->editable == false)
        inert="inert"
    @endif
    action="{{ ( isset($action) )?$action:"#"  }}">

    @csrf
    @if (session('drafr_save'))
        <div class="form-status form-status--success">
            {{ session('drafr_save') }}
        </div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">
            {{ $error }}
        </div>
    @endforeach




    <input type="hidden" name="item_id" value="{{ $item->id ?? 0 }}">
    <input type="hidden" name="verified" value="{{ $item->verified ?? false }}">
    <input type="hidden" name="document_type" value="1">

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Ф.И.О. заявителя<sup>*</sup>
            </span>
            <input type="text" name="name" class="form-elem__field"  value="{{ $item->name ?? old('name') ?? get_fio_str() }}">
            @error('name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Организация<sup>*</sup>
            </span>
            <input type="text" name="organization" class="form-elem__field"  value="{{ $item->organization ?? old('organization') ?? '' }}">
            @error('organization')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Должность<sup>*</sup>
            </span>
            <input type="text" name="dolgnost" class="form-elem__field"  value="{{ $item->dolgnost ?? old('dolgnost') ?? '' }}">
            @error('dolgnost')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Телефон<sup>*</sup>
            </span>
            <input type="text" name="phone" class="form-elem__field tel-mask"  value="{{ $item->phone ?? old('phone') ??  auth()->user()->phone }}">
            @error('phone')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <label class="form-elem">
        <span class="form-elem__caption">
            Адрес заявителя<sup>*</sup>
        </span>
        <input type="text" name="zayavitel_adress" class="form-elem__field"  value="{{ $item->zayavitel_adress ?? old('zayavitel_adress') ?? '' }}">
        @error('zayavitel_adress')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Информациф об объекте</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Наименование объекта<sup>*</sup>
        </span>
        <input type="text" name="object_name" class="form-elem__field"  value="{{ $item->object_name ?? old('object_name') ?? '' }}">
        @error('object_name')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Тип объекта<sup>*</sup>
        </span>
        <select name="object_type" class="select-ch select-ch--no-search" id="">
            <option value="" disabled selected>Выберите тип проекта</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Масштабный инвестиционный проект')) value="Масштабный инвестиционный проект">Масштабный инвестиционный проект</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Социально-культурного назначения')) value="Социально-культурного назначения">Социально-культурного назначения</option>
            <option @selected(isset($item->object_type) && ($item->object_type === 'Коммунально-бфтового назначения')) value="Коммунально-бытового назначения">Коммунально-бытового назначения</option>
        </select>

        @error('object_type')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>



    @if ($format !== "create" )
        <h3>Приложения</h3>

            <div class="attachment-files-box">
                @foreach ($item->attachment as $file)
                    <div class="attachment-file">
                        <a href="{{ Storage::url($file->storage_patch."/".$file->file)}}"> {{ $file->file_real }}</a>
                        <button class="attachment-file__btn close-icon" type="submit" title="Удалить вложение" name="att_delete" value="{{ $file->id }}"> </button>
                    </div>
                @endforeach
            </div>


        <div class="file-funnel">
            <input type="file" name="attachment[]" class="file-funnel__file-input" multiple="multiple">
            <div class="file-funnel__text">
                <span class="file-funnel__caption">
                    Загрузить файлы
                </span>
                <span class="file-funnel__direction">
                    В форматах doc, docx, pdf, jpg, png
                </span>
            </div>
            <div class="file-funnel__receiver">
                +
            </div>
            <div class="file-funnel__docs">
                <button type="button" class="file-funnel-btn file-funnel-btn--reset">Очистить</button>
            </div>
        </div>
    @endif


    <label class="form-elem">
        <span class="form-elem__caption">
            Страниц в приложении
        </span>
        <input type="number" name="prilogenie_list_count" class="form-elem__field"  value="{{ $item->prilogenie_list_count ?? old('prilogenie_list_count') ?? '' }}">
        @error('prilogenie_list_count')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>




     <x-edit-form-elements.main-control :format="$format" :item="$item ?? null" doct="area_get" deleteroat="area_get_delete" ></x-edit-form-elements.main-control>



</form>

<x-edit-form-elements.blocked-control :format="$format" :item="$item ?? null" doct="area_get" printroute="area_get_print" ></x-edit-form-elements.blocked-control>

