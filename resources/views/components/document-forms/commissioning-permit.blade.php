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

    <x-form.input name="supplier_org" label="Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти" :required="true" value="{{ $item->supplier_org ?? old('supplier_org') }}" />

    <h3>Сведения о застройщике</h3>
    <x-form.select name="applicant_type" label="Тип заявителя" :required="true" :list="['Физическое лицо','Индивидуальный предприниматель','Юридическое лицо']" :value="$item->applicant_type ?? old('applicant_type') ?? 'Физическое лицо' " />

    <div class="columns-box columns-box--two-col">

        <x-form.input name="applicant_name" label="Наименование заявителя" :required="true" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="applicant_ogrn" label="ОГРН заявителя (если есть)" :required="true" value="{{ $item->applicant_ogrn ?? old('applicant_ogrn') }}" />
        <x-form.input name="applicant_inn" label="ИНН заявителя" :required="true" value="{{ $item->applicant_inn ?? old('applicant_inn') }}" />
        <x-form.input name="applicant_passport_data" label="Паспортные данные заявителя (если физическое лицо)" :required="true" value="{{ $item->applicant_passport_data ?? old('applicant_passport_data') }}" />
    </div>

    <h3>Сведения об объекте</h3>
    <div class="columns-box columns-box--two-col">
        <x-form.input name="object_name" label="Наименование объекта капитального строительства" :required="true" value="{{ $item->object_name ?? old('object_name') }}" />
        <x-form.input name="object_address" label="Адрес (местоположение) объекта" :required="true" value="{{ $item->object_address ?? old('object_address') }}" />
    </div>

    <h3>Сведения о земельном участке</h3>
    <x-form.input name="land_cadastral_number" label="Кадастровый номер земельного участка" :required="false" value="{{ $item->land_cadastral_number ?? old('land_cadastral_number') }}" />

    <h3>Сведения о разрешении на строительство</h3>
    <x-form.input name="permit_authority" label="Наименование органа, выдавшего разрешение" :required="false" value="{{ $item->permit_authority ?? old('permit_authority') }}" />
    <div class="columns-box columns-box--two-col">
        <x-form.input name="permit_number" label="Номер документа" :required="false" value="{{ $item->permit_number ?? old('permit_number') }}" />
        <x-form.input type="date" name="permit_date" label="Дата выдачи разрешения" :required="false" value="{{ $item->permit_date ?? old('permit_date') }}" />
    </div>

    <h3>Сведения о ранее выданных разрешениях на ввод объекта в эксплуатацию в отношении этапа строительства, реконструкции объекта капитального строительства (при наличии) (указывается в случае, предусмотренном частью 35 статьи 55 Градостроительного кодекса Российской Федерации)</h3>

    <x-form.input name="previous_permit_authority" label="Наименование органа, выдавшего разрешение" :required="false" value="{{ $item->previous_permit_authority ?? old('previous_permit_authority') }}" />
    <div class="columns-box columns-box--two-col">
        <x-form.input name="previous_permit_number" label="Номер документа" :required="false" value="{{ $item->previous_permit_number ?? old('previous_permit_number') }}" />

            <x-form.input type="date" name="previous_permit_date" label="Дата выдачи разрешения" :required="false" value="{{ $item->previous_permit_date ?? old('previous_permit_date') }}" />
    </div>

    <h3>При этом сообщаю, что ввод объекта в эксплуатацию будет осуществляться на основании следующих документов:</h3>

    <x-form.select name="doc_name" label="Наименование документа" :required="false"
    value="{{ $item->doc_name ?? old('doc_name') ?? 'Заключение уполномоченного на осуществление федерального государственного экологического надзора федерального органа исполнительной власти' }}"

    :list="[
        'Градостроительный план земельного участка или в случае строительства линейного объекта реквизиты проекта планировки и проекта межевания проекта планировки территории в случае выдачи разрешения на строительство линейного объекта, для размещения которого не требуется образование земельного участка',
        'Заключение органа государственного строительного надзора о соответствии построенного, реконструированного объекта капитального строительства требованиям проектной документации',
        'Заключение уполномоченного на осуществление федерального государственного экологического надзора федерального органа исполнительной власти']"
    />

    <div class="columns-box columns-box--two-col">
        <x-form.input name="doc_number" label="Номер документа" :required="false" value="{{ $item->doc_number ?? old('doc_number') }}" />
        <x-form.input type="date" name="doc_date" label="Дата выдачи документа" :required="false" value="{{ $item->doc_date ?? old('doc_date') }}" />
    </div>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="phone" label="Телефон" :required="false" value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone}}" />
        <x-form.input name="email" label="Адрес электронной почты" :required="false" value="{{ $item->email ?? old('email') ?? auth()->user()->email }}" />
    </div>

    <h3>Результат предоставления услуги прошу:</h3>

    <x-form.select name="send_result_type" label="Вид отправки результата оказания услуги" :required="false"
    value="{{ $item->send_result_type ?? old('send_result_type') ?? 'Направить в форме электронного документа в личный кабинет в Федеральной государственной информационной системе «Единый портал государственных и муниципальных услуг (функций)»/на региональном портале государственных и муниципальных услуг' }}"
    :list="[
        'Направить в форме электронного документа в личный кабинет в Федеральной государственной информационной системе «Единый портал государственных и муниципальных услуг (функций)»/на региональном портале государственных и муниципальных услуг',
        'Выдать на бумажном носителе при личном обращении в комитет либо в многофункциональный центр предоставления государственных и муниципальных услуг',
        'Направить на бумажном носителе на почтовый адрес']"
    />

    <x-form.input name="send_mfc_adress" label="Адрес коммитета или МФЦ для отправки результата" :required="false" value="{{ $item->send_mfc_adress ?? old('send_mfc_adress') }}" />
    <x-form.input name="send_post_adress" label="Адрес для почтового оформления" :required="false" value="{{ $item->send_post_adress ?? old('send_post_adress') }}" />

    {{-- Конец формы --}}


    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>

<x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>
</form>


