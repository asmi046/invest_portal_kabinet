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

    <x-form.input name="supplier_org" label="Организация в которую подается заявление" :required="true" value="{{ $item->supplier_org ?? old('supplier_org') }}" />

    <h3>Сведения о физическом лице (или ИП)</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_name" label="Наименование заявителя" :required="true" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="applicant_ogrn" label="ОГРНИП заявителя (если есть)" :required="true" value="{{ $item->applicant_ogrn ?? old('applicant_ogrn') }}" />
        <x-form.input name="applicant_inn" label="ИНН заявителя" :required="true" value="{{ $item->applicant_inn ?? old('applicant_inn') }}" />
        <x-form.input name="applicant_passport_data" label="Паспортные данные заявителя (если физическое лицо)" :required="true" value="{{ $item->applicant_passport_data ?? old('applicant_passport_data') }}" />
    </div>

    <h3>Сведения о юридическом лице </h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_company_name" label="Наименование компании" :required="true" value="{{ $item->applicant_company_name ?? old('applicant_company_name') }}" />
        <x-form.input name="applicant_company_ogrn" label="ОГРН заявителя" :required="true" value="{{ $item->applicant_company_ogrn ?? old('applicant_company_ogrn') }}" />
        <x-form.input name="applicant_company_inn" label="ИНН заявителя" :required="true" value="{{ $item->applicant_company_inn ?? old('applicant_company_inn') }}" />
        <x-form.input name="applicant_company_passport_data" label="Паспортные данные руководителя" :required="true" value="{{ $item->applicant_company_passport_data ?? old('applicant_company_passport_data') }}" />
    </div>

    <h3>Сведения о представителе</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_predst_name" label="Наименование компании" :required="false" value="{{ $item->applicant_predst_name ?? old('applicant_predst_name') }}" />
        <x-form.input name="applicant_predst_ogrn" label="ОГРН заявителя" :required="false" value="{{ $item->applicant_predst_ogrn ?? old('applicant_predst_ogrn') }}" />
        <x-form.input name="applicant_predst_inn" label="ИНН заявителя" :required="false" value="{{ $item->applicant_predst_inn ?? old('applicant_predst_inn') }}" />
        <x-form.input name="applicant_predst_passport_data" label="Паспортные данные руководителя" :required="false" value="{{ $item->applicant_predst_passport_data ?? old('applicant_predst_passport_data') }}" />
    </div>

    <x-form.input name="rep_doc_issued_at" label="Реквизиты документа, подтверждающие полномочия представителя" :required="false" value="{{ $item->rep_doc_issued_at ?? old('rep_doc_issued_at') }}" />

    <h3>Сведения об объекте</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="object_name" label="Наименование объекта капитального строительства" :required="true" value="{{ $item->object_name ?? old('object_name') }}" />
        <x-form.input name="object_cadastral_number" label="Кадастровый номер объекта" :required="true" value="{{ $item->object_cadastral_number ?? old('object_cadastral_number') }}" />
    </div>

    <h3>Сведения о земельном участке</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="land_cadastral_number" label="Кадастровый номер земельного участка" :required="true" value="{{ $item->land_cadastral_number ?? old('land_cadastral_number') }}" />
        <x-form.input name="land_docs" label="Реквизиты утвержденного проекта межевания территории" :required="true" value="{{ $item->land_docs ?? old('land_docs') }}" />
    </div>

    <h3>При этом сообщаю, что строительство/реконструкция объекта капитального строительства будет осуществляться на основании следующих документов:</h3>
    <x-form.select name="doc_name" label="Наименование документа" :required="false"
    value="{{ $item->doc_name ?? old('doc_name') ?? 'Градостроительный план земельного участка или в случае строительства линейного объекта реквизиты проекта планировки и проекта межевания территории (за исключением случаев, при которых для строительства, реконструкции линейного объекта не требуется подготовка документации по планировке территории), реквизиты проекта планировки территории в случае выдачи разрешения на строительство линейного объекта, для размещения которого не требуется образование земельного участка' }}"

    :list="[
        'Градостроительный план земельного участка или в случае строительства линейного объекта реквизиты проекта планировки и проекта межевания территории (за исключением случаев, при которых для строительства, реконструкции линейного объекта не требуется подготовка документации по планировке территории), реквизиты проекта планировки территории в случае выдачи разрешения на строительство линейного объекта, для размещения которого не требуется образование земельного участка',
        'Типовое архитектурное решение для исторического поселения (при н наличии) (указывается в случае выдачи разрешение на строительство объекта в границах территории исторического поселения федерального или регионального значения)',
        'Положительное заключение экспертизы проектной документации (указывается в случаях, если проектная документация подлежит экспертизе в соответствии со статьей 49 Градостроительного кодекса Российской Федерации)',
        'Положительное заключение государственной кологической экспертизы проектной документации (указываются реквизиты приказа об утверждении заключения в случаях, если проектная документация подлежит экологической экспертизе в соответствии со статьей 49 Градостроительного кодекса Российской Федерации)'
        ]"
    />
    <div class="columns-box columns-box--two-col">
        <x-form.input name="doc_number" label="Номер документа" :required="false" value="{{ $item->doc_number ?? old('doc_number') }}" />
                   {{-- @php
    dd($item->doc_date, old('doc_date'))
    @endphp --}}
            <x-form.input type="date" name="doc_date" label="Дата выдачи документа" :required="false" value="{{ $item->doc_date ?? old('doc_date') }}" />
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

    <h3>Контакты</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="phone" label="Телефон" :required="false" value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone}}" />
        <x-form.input name="email" label="Адрес электронной почты" :required="false" value="{{ $item->email ?? old('email') ?? auth()->user()->email }}" />
    </div>

    <h3>Результат рассмотрения настоящего заявления прошу:</h3>
    <x-form.select name="send_result_type" label="Вид отправки результата оказания услуги" :required="false"
    value="{{ $item->send_result_type ?? old('send_result_type') ?? 'Направить в форме электронного документа в личный кабинет в Федеральной государственной информационной системе «Единый портал государственных и муниципальных услуг (функций)»/на региональном портале государственных и муниципальных услуг' }}"
    :list="[
        'Направить в форме электронного документа в личный кабинет в Федеральной государственной информационной системе «Единый портал государственных и муниципальных услуг (функций)»/на региональном портале государственных и муниципальных услуг',
        'Выдать на бумажном носителе при личном обращении в комитет либо в многофункциональный центр предоставления государственных и муниципальных услуг',
        'выдать на бумажном носителе при личном обращении в комитет архитектуры и градостроительства Курской области']"
    />

    <x-form.input name="send_mfc_adress" label="Адрес коммитета или МФЦ для отправки результата" :required="false" value="{{ $item->send_mfc_adress ?? old('send_mfc_adress') }}" />

    {{-- Конец формы --}}


    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
    <x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>
</form>
