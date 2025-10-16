<form enctype='multipart/form-data'
    @class(['form-project-submission', 'flex-form', 'form_disabled' => isset($item) && !$item->editable ])
    method="POST"
    @if (isset($item) && $item->editable == false)
        {{-- inert="inert" --}}
    @endif
    action="{{ $documentType->index_url }}/save"
>

    @csrf

    <x-form.form-message></x-form.form-message>

    <x-form.all-error></x-form.all-error>

    <input type="hidden" name="id" value="{{ $item->id ?? 0 }}">
    <input type="hidden" name="verified" value="{{ $item->verified ?? false }}">
    <input type="hidden" name="document_type" value="{{ $documentType->id ?? 1 }}">

    {{-- Начало формы --}}
    <div class="columns-box columns-box--two-col">
        <x-form.input
            name="name"
            label="ФИО"
            :required="true"
            value="{{ $item->name ?? old('name') }}"
        />

        <x-form.input
            name="organization"
            label="Название организации"
            :required="true"
            value="{{ $item->organization ?? old('organization') }}"
        />

        <x-form.input
            name="dolgnost"
            label="Должность"
            :required="true"
            value="{{ $item->dolgnost ?? old('dolgnost') }}"
        />

        <x-form.input
            name="phone"
            label="Телефон"
            type="tel"
            :required="true"
            value="{{ $item->phone ?? old('phone') }}"
        />

        <x-form.input
            name="egrul"
            label="ЕГРЮЛ/ЕГРИП"
            :required="true"
            value="{{ $item->egrul ?? old('egrul') }}"
        />

        <x-form.input
            name="okved"
            label="ОКВЭД"
            :required="true"
            value="{{ $item->okved ?? old('okved') }}"
        />
    </div>

    <x-form.input
        name="adress"
        label="Адрес регистрации"
        :required="true"
        value="{{ $item->adress ?? old('adress') }}"
    />

    <h3>Информация об объекте</h3>
    <div class="columns-box columns-box--two-col">
        <x-form.input
            name="project_name"
            label="Наименование проекта"
            :required="false"
            value="{{ $item->project_name ?? old('project_name') }}"
        />

        <x-form.input
            name="cadastr_number"
            label="Кадастровый номер"
            :required="false"
            value="{{ $item->cadastr_number ?? old('cadastr_number') }}"
        />

        <x-form.input
            name="geo"
            label="Координаты объекта"
            :required="false"
            value="{{ $item->geo ?? old('geo') }}"
        />

        <x-form.input
            name="object_place_name"
            label="Место нахождения объекта"
            :required="false"
            value="{{ $item->object_place_name ?? old('object_place_name') }}"
        />
    </div>

    <h3>Информация о подключении</h3>

    <x-form.select-key
        name="osnovanie"
        label="Всвязи с:"
        :required="true"
        :list="[
            'Изменением текущей мощьности и схем подключения' => 'Изменением текущей мощьности и схем подключения',
            'Увеличение присоединенной мощьности' => 'Увеличение присоединенной мощьности',
            'Новым присоединением' => 'Новым присоединением'
        ]"
        value="{{ $item->osnovanie ?? old('osnovanie') ?? 'Изменением текущей мощьности и схем подключения' }}"
    />

    <x-form.input
        name="ustroistvo"
        label="Наименование энергопринимающих устройств"
        :required="true"
        value="{{ $item->ustroistvo ?? old('ustroistvo') }}"
    />

    <x-form.input
        name="raspologeie"
        label="Место нахождения энергопринимающих устройств"
        :required="true"
        value="{{ $item->raspologeie ?? old('raspologeie') }}"
    />

    <x-form.input
        name="point_count"
        label="Количество точек подключения"
        type="number"
        :required="true"
        value="{{ $item->point_count ?? old('point_count') ?? 1 }}"
    />

    <x-form.select
        name="safety_category"
        label="Категория надежности"
        :required="true"
        :list="['Первая', 'Вторая', 'Третья']"
        value="{{ $item->safety_category ?? old('safety_category') ?? 'Первая' }}"
    />

    <div class="form-elem">
        <h4>Расшифровка</h4>
        <ul>
            @foreach (config('resource_data.safety_categoryes') as $key => $value)
                <li><strong>{{ $key}}</strong> - {{ $value }}</li>
            @endforeach
        </ul>
    </div>

    <h3>Максимальная мощность энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <x-form.input
            name="pover_prin_devices"
            label="Мощность (кВт)"
            :required="true"
            value="{{ $item->pover_prin_devices ?? old('pover_prin_devices') }}"
        />

        <x-form.input
            name="napr_prin_devices"
            label="При напряжении (кВ)"
            :required="true"
            value="{{ $item->napr_prin_devices ?? old('napr_prin_devices') }}"
        />
    </div>

    <h3>Максимальная мощность присоединяемых энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <x-form.input
            name="pover_pris_devices"
            label="Мощность (кВт)"
            :required="true"
            value="{{ $item->pover_pris_devices ?? old('pover_pris_devices') }}"
        />

        <x-form.input
            name="napr_pris_devices"
            label="При напряжении (кВ)"
            :required="true"
            value="{{ $item->napr_pris_devices ?? old('napr_pris_devices') }}"
        />
    </div>

    <h3>Максимальная мощность ранее присоединенных в данной точке</h3>
    <div class="columns-box columns-box--two-col">
        <x-form.input
            name="pover_pris_r_devices"
            label="Мощность (кВт)"
            :required="false"
            value="{{ $item->pover_pris_r_devices ?? old('pover_pris_r_devices') }}"
        />

        <x-form.input
            name="napr_pris_r_devices"
            label="При напряжении (кВ)"
            :required="false"
            value="{{ $item->napr_pris_r_devices ?? old('napr_pris_r_devices') }}"
        />
    </div>

    <h3>Необходимые документы</h3>

    <x-tc.att-document :item="$item ?? NULL" param="plan_raspologenia" name="План расположения энергопринимающих устройств"></x-tc.att-document>
    <x-tc.att-document :item="$item ?? NULL" param="pravo_sobstv" name="Документ подтверждающий право собственности на объект или иное предусмотренное законом основание"></x-tc.att-document>
    <x-tc.att-document :item="$item ?? NULL" param="perechen" name="Перечень и мощьность энерго принимающих устройств присоединенных к устройствам противоаварийной автоматики"></x-tc.att-document>

    @if ($format !== "create" )
        <h3>Приложения</h3>
        @if ($item->attachment)
            <div class="attachment-files-box">
                @foreach ($item->attachment as $file)
                    <div class="attachment-file">
                            <a href="{{ Storage::url($file->storage_patch."/".$file->file)}}" class="attachment-file__name"> {{ $file->file_real }}</a>
                            <button class="attachment-file__btn close-icon" type="submit" title="Удалить вложение" name="att_delete" value="{{ $file->id }}"> </button>
                    </div>
                @endforeach
            </div>
        @endif

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

        <x-form.textarea
            name="prilogenie"
            label="Приложения к заявлению"
            placeholder="Опишите все приложенные документы в свободной форме"
            :required="false"
            value="{{ $item->prilogenie ?? old('prilogenie') }}"
        />
    @endif
    {{-- Конец формы --}}

    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
    <x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>
</form>


