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
        <x-form.input name="name" label="Ф.И.О. заявителя" :required="false" value="{{ $item->name ?? old('name') ?? get_fio_str() }}" />

        <x-form.input name="organization" label="Организация" :required="true" value="{{ $item->organization ?? old('organization') ?? '' }}" />

        <x-form.input name="dolgnost" label="Должность" :required="true" value="{{ $item->dolgnost ?? old('dolgnost') ?? '' }}" />

        <x-form.input name="phone" label="Телефон" :required="true" value="{{ $item->phone ?? old('phone') ??  auth()->user()->phone }}" />
    </div>

    <x-form.input name="zayavitel_adress" label="Адрес заявителя" :required="true" value="{{ $item->zayavitel_adress ?? old('zayavitel_adress') ?? '' }}" />

    <h3>Информациф об объекте</h3>

    <x-form.input name="object_name" label="Наименование объекта" :required="true" value="{{ $item->object_name ?? old('object_name') ?? '' }}" />

    <x-form.select name="object_type" label="Тип объекта" :required="true" :item="$item ?? null" :value="$item->object_type ?? old('object_type') ?? ''"
        :list="['Масштабный инвестиционный проект', 'Социально-культурного назначения', 'Коммунально-бытового назначения']" />


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


        <x-form.file name="attachment[]" label="Загрузить файлы" format="В форматах doc, docx, pdf, jpg, png"></x-form.file>

    @endif


    <x-form.input type="number" name="prilogenie_list_count" label="Страниц в приложении" :required="true" value="{{ $item->prilogenie_list_count ?? old('prilogenie_list_count') ?? '' }}" />

    <x-form.main-control :format="$format" :item="$item ?? null" doct="area_get" deleteroat="area_get_delete" ></x-form.main-control>



</form>

<x-form.blocked-control :format="$format" :item="$item ?? null" doct="area_get" printroute="area_get_print" ></x-form.blocked-control>

