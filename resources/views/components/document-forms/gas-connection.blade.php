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

    <h3>Сведения о заявителе</h3>

    {{-- @php
    dd($item->applicant_ogrn_data, old('applicant_ogrn_data'))
    @endphp --}}

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_name" label="Заявитель" :required="true" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="applicant_ogrn" label="ОГРН / ОГРНИП" :required="true" value="{{ $item->applicant_ogrn ?? old('applicant_ogrn') }}" />
        <x-form.input type="date" name="applicant_ogrn_data" label="ОГРН / ОГРНИП (дата регистрации)" :required="true" value="{{ $item->applicant_ogrn_data ?? old('applicant_ogrn_data') }}" />
        <x-form.input name="applicant_address" label="Адрес заявителя" :required="true" value="{{ $item->applicant_address ?? old('applicant_address') }}" />
    </div>

    <x-form.textarea name="applicant_passport_data" label="Паспортные данные" :required="true" value="{{ $item->applicant_passport_data ?? old('applicant_passport_data') }}" />

    <x-form.textarea name="applicant_connect_variants" label="Способы обмена информацией" :required="false" value="{{ $item->applicant_connect_variants ?? old('applicant_connect_variants') }}" />

    <h3>Контактная информация</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="phone" label="Телефон" :required="true" value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone}}" />
        <x-form.input name="email" label="Адрес электронной почты" :required="false" value="{{ $item->email ?? old('email') ?? auth()->user()->email }}" />
    </div>

    <h3>Документы на земельный участок</h3>

    <x-form.input name="land_docs" label="Реквизиты утвержденного проекта межевания территории либо сведения о наличии схемы расположения земельного участка" :required="false" value="{{ $item->land_docs ?? old('land_docs') }}" />

    <h3>Сведения об объекте</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="object_name" label="Наименование объекта" :required="true" value="{{ $item->object_name ?? old('object_name') }}" />
        <x-form.input name="object_address" label="Адрес (местоположение) объекта" :required="true" value="{{ $item->object_address ?? old('object_address') }}" />
    </div>

    <x-form.input name="reason" label="Основание для подключения к газораспределительной сети" :required="false" value="{{ $item->reason ?? old('reason') }}" />

    <h3>Необходимые работы</h3>

    <div class="columns-box columns-box--two-col">
        {{-- @dd($item, old('need_any_works')) --}}
        <x-form.select-key name="need_any_works" label="Необходимость дополнительных работ" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_any_works ?? old('need_any_works') ?? 1" />
        <x-form.select-key name="need_design" label="Необходимость проектирования" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_design ?? old('need_design') ?? 0" />
        <x-form.select-key name="need_equipment_installation" label="Необходимость установки оборудования" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_equipment_installation ?? old('need_equipment_installation') ?? 0" />
        <x-form.select-key name="need_pipeline_construction" label="Необходимость либо реконструкции внутреннего газопровода" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_pipeline_construction ?? old('need_pipeline_construction') ?? 0" />
        <x-form.select-key name="need_meter_installation" label="Необходимость установки прибора учета газа" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_meter_installation ?? old('need_meter_installation') ?? 0" />
        <x-form.select-key name="need_meter_supply" label="Необходимость поставки прибора учета газа" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_meter_supply ?? old('need_meter_supply') ?? 0" />
        <x-form.select-key name="need_equipment_supply" label="Необходимость по поставке газоиспользующего оборудования" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->need_equipment_supply ?? old('need_equipment_supply') ?? 0" />
    </div>

    <h3>Параметры потребления газа</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input-num name="gas_flow_total" label="Величина максимального часового расхода газа (мощности)" step="0.1" :required="true" value="{{ $item->gas_flow_total ?? old('gas_flow_total') }}" />
        <x-form.input-num name="gas_flow_new" label="Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования" type="number" step="0.1" :required="true" value="{{ $item->gas_flow_new ?? old('gas_flow_new') }}" />
        <x-form.input-num name="gas_flow_existing" label="Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования" type="number" step="0.1" :required="true" value="{{ $item->gas_flow_existing ?? old('gas_flow_existing') }}" />
        <x-form.input name="planned_date" label="Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства" type="date" :required="true" value="{{ $item->planned_date ?? old('planned_date') }}" />
    </div>

    <h3>Точка подключения</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="connection_point" label="Точка подключения" type="number" :required="true" value="{{ $item->connection_point ?? old('connection_point') }}" />
        <x-form.input name="connection_planned_date" label="Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства, в том числе по этапам и очередям (месяц, год)" type="date" :required="true" value="{{ $item->connection_planned_date ?? old('connection_planned_date') }}" />
        <x-form.input-num name="connection_flow_total" label="Итоговая величина максимального часового расхода газа" type="number" step="0.1" :required="true" value="{{ $item->connection_flow_total ?? old('connection_flow_total') }}" />
        <x-form.input-num name="connection_flow_new" label="Величина максимального расхода газа" type="number" step="0.1" :required="true" value="{{ $item->connection_flow_new ?? old('connection_flow_new') }}" />
        <x-form.input-num name="connection_flow_existing" label="Величина максимального расхода газа" type="number" step="0.1" :required="true" value="{{ $item->connection_flow_existing ?? old('connection_flow_existing') }}" />
    </div>

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


        <x-form.file name="attachment[]" label="Загрузить файлы" format="В форматах pdf"></x-form.file>
        <x-form.textarea name="attention_details" label="Описание вложений" :required="false" value="{{ $item->attention_details ?? old('attention_details') }}" />
    @endif

    <h3>Дополнительная информация</h3>

    <x-form.input name="consumption_type" label="Характеристика потребления газа (вид экономической деятельности заявителя - юридического лица или индивидуального предпринимателя)" :required="false" value="{{ $item->consumption_type ?? old('consumption_type') }}" />

    <div class="columns-box columns-box--two-col">
        <x-form.input name="previous_tech_number" label="Номер ранее выданных технических условий" :required="false" value="{{ $item->previous_tech_number ?? old('previous_tech_number') }}" />
        <x-form.input type="date" name="previous_tech_date" label="Дата ранее выданных технических условий" :required="false" value="{{ $item->previous_tech_date ?? old('previous_tech_date') }}" />
    </div>

    <x-form.textarea name="additional_info" label="Дополнительная информация" :required="false" value="{{ $item->additional_info ?? old('additional_info') }}" />

    <x-form.input name="notification_method" label="Способ уведомления о подключении" :required="false" value="{{ $item->notification_method ?? old('notification_method') }}" />

    {{-- Конец формы --}}


    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
    <x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>
</form>


