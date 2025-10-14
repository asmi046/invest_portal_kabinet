<form enctype='multipart/form-data'
    @class(['form-project-submission', 'flex-form', 'form_disabled' => isset($item) && !$item->editable ])
    method="POST"
    @if (isset($item) && $item->editable == false)
        inert="inert"
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

        <x-form.input name="supplier_org" label="Организация в которую подается заявление" :required="false" value="{{ $item->supplier_org ?? old('supplier_org') }}" />

    <h3>Сведения о заявителе</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_name" label="Наименование заявителя" :required="true" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="applicant_ogrn" label="ОГРН / ОГРНИП заявителя" :required="true" value="{{ $item->applicant_ogrn ?? old('applicant_ogrn') }}" />
        <x-form.input name="applicant_inn" label="ИНН заявителя" :required="true" value="{{ $item->applicant_inn ?? old('applicant_inn') }}" />
        <x-form.input name="applicant_address" label="Адрес заявителя" :required="true" value="{{ $item->applicant_address ?? old('applicant_address') }}" />
        <x-form.input name="person" label="ФИО представителя заявителя" :required="false" value="{{ $item->person ?? old('person') }}" />
        <x-form.input name="person_dover" label="Наименование и реквизиты документа, подтверждающего полномочия представителя заявителя" :required="false" value="{{ $item->person_dover ?? old('person_dover') }}" />
    </div>

    <h3>Контактная информация для связи с заявителем</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="phone" label="Телефон" :required="true" value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone}}" />
        <x-form.input name="email" label="Адрес электронной почты" :required="false" value="{{ $item->email ?? old('email') ?? auth()->user()->email }}" />
        <x-form.input name="post_address" label="Почтовый адрес" :required="true" value="{{ $item->post_address ?? old('post_address') }}" />
    </div>

    <h3>Сведения о земельном участке</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="land_cadastral_number" label="Кадастровый номер земельного участка" :required="true" value="{{ $item->land_cadastral_number ?? old('land_cadastral_number') }}" />
        <x-form.input name="area" label="Площадь земельного участка (кв.м)" :required="true" type="number" step="0.01" value="{{ $item->area ?? old('area') ?? '0' }}" />
        <x-form.input name="lease_term" label="Срок аренды земельного участка" :required="true" value="{{ $item->lease_term ?? old('lease_term') }}" />
        <x-form.input name="landmarks" label="Адресные ориентиры земельного участка" :required="false" value="{{ $item->landmarks ?? old('landmarks') ?? '-' }}" />
    </div>

    <x-form.textarea name="purpose" label="Цель использования земельного участка" :required="true" value="{{ $item->purpose ?? old('purpose') }}" />

    <x-form.textarea name="basis" label="Основание предоставления земельного участка без проведения торгов" :required="true" value="{{ $item->basis ?? old('basis') }}" />

    <x-form.input name="req_dock" label="Реквизиты решения о предварительном согласовании предоставления земельного участка" :required="false" value="{{ $item->req_dock ?? old('req_dock') ?? '-' }}" />

    <x-form.input name="req_dock_plan" label="Реквизиты решения об утверждении документа территориального планирования и (или) проекта планировки территории" :required="false" value="{{ $item->req_dock_plan ?? old('req_dock_plan') ?? '-' }}" />

    <x-form.input name="req_dock_iz" label="Реквизиты решения об изъятии земельного участка для государственных или муниципальных нужд" :required="false" value="{{ $item->req_dock_iz ?? old('req_dock_iz') ?? '-' }}" />

    {{-- Конец формы --}}


    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
</form>

<x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>

