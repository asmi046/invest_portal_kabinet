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

    <h3>Сведения о заявителе</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_name" label="Наименование заявителя" :required="true" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="applicant_address_ur" label="Юридический адрес заявителя" :required="true" value="{{ $item->applicant_address_ur ?? old('applicant_address_ur') }}" />
        <x-form.input name="applicant_address_post" label="Почтовый адрес заявителя" :required="true" value="{{ $item->applicant_address_post ?? old('applicant_address_post') }}" />
        <x-form.input name="applicant_phone" label="Телефон заявителя" :required="false" value="{{ $item->applicant_phone ?? old('applicant_phone') ?? auth()->user()->phone }}" />
        <x-form.input name="applicant_ogrn" label="ОГРН / ОГРНИП" :required="true" value="{{ $item->applicant_ogrn ?? old('applicant_ogrn') }}" />
        <x-form.input name="applicant_inn_kpp" label="ИНН" :required="true" value="{{ $item->applicant_inn_kpp ?? old('applicant_inn_kpp') }}" />
    </div>

    <h3>Банковские реквизиты заявителя</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_bank_name" label="Наименование банка заявителя" :required="false" value="{{ $item->applicant_bank_name ?? old('applicant_bank_name') }}" />
        <x-form.input name="applicant_bank_rs" label="Расчетный счет банка заявителя" :required="false" value="{{ $item->applicant_bank_rs ?? old('applicant_bank_rs') }}" />
        <x-form.input name="applicant_bank_ks" label="Корреспондентский счет банка заявителя" :required="false" value="{{ $item->applicant_bank_ks ?? old('applicant_bank_ks') }}" />
        <x-form.input name="applicant_bank_bik" label="БИК банка заявителя" :required="false" value="{{ $item->applicant_bank_bik ?? old('applicant_bank_bik') }}" />
    </div>

    <h3>Сведения об объекте</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="object_name" label="Наименование объекта" :required="true" value="{{ $item->object_name ?? old('object_name') }}" />
        <x-form.input name="object_address" label="Адрес (местоположение) объекта" :required="true" value="{{ $item->object_address ?? old('object_address') }}" />
    </div>

    <h3>Тепловая нагрузка - ВСЕГО</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="teplovaya_nagruzka_vsego_chasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч всего часовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_vsego_chasovaya_maksimalnaya ?? old('teplovaya_nagruzka_vsego_chasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_vsego_chasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч всего часовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_vsego_chasovaya_minimalnaya ?? old('teplovaya_nagruzka_vsego_chasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч всего среднечасовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya ?? old('teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч всего среднечасовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya ?? old('teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_vsego_rashetnyi" label="Расход теплоносителя, т/ч — всего расчетный" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_vsego_rashetnyi ?? old('raskhod_teplonositelya_vsego_rashetnyi') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_vsego_srednechasovoy" label="Расход теплоносителя, т/ч — всего среднечасовой" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_vsego_srednechasovoy ?? old('raskhod_teplonositelya_vsego_srednechasovoy') ?? '0' }}" />
    </div>

    <h3>Тепловая нагрузка - ОТОПЛЕНИЕ</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч отопление часовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya ?? old('teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч отопление часовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya ?? old('teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч отопление среднечасовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya ?? old('teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч отопление среднечасовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya ?? old('teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_otoplenie_rashetnyi" label="Расход теплоносителя, т/ч — отопление расчетный" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_otoplenie_rashetnyi ?? old('raskhod_teplonositelya_otoplenie_rashetnyi') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_otoplenie_srednechasovoy" label="Расход теплоносителя, т/ч — отопление среднечасовой" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_otoplenie_srednechasovoy ?? old('raskhod_teplonositelya_otoplenie_srednechasovoy') ?? '0' }}" />
    </div>

    <h3>Тепловая нагрузка - ВЕНТИЛЯЦИЯ</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч вентиляция часовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya ?? old('teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч вентиляция часовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya ?? old('teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya ?? old('teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya ?? old('teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_ventilyatsia_rashetnyi" label="Расход теплоносителя, т/ч — вентиляция расчетный" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_ventilyatsia_rashetnyi ?? old('raskhod_teplonositelya_ventilyatsia_rashetnyi') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_ventilyatsia_srednechasovoy" label="Расход теплоносителя, т/ч — вентиляция среднечасовой" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_ventilyatsia_srednechasovoy ?? old('raskhod_teplonositelya_ventilyatsia_srednechasovoy') ?? '0' }}" />
    </div>

    <h3>Тепловая нагрузка - ГОРЯЧЕЕ ВОДОСНАБЖЕНИЕ</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya ?? old('teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya ?? old('teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya" label="Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — максимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya ?? old('teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya') ?? '0' }}" />
        <x-form.input name="teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya" label="Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — минимальная" type="number" step="0.01" :required="true" value="{{ $item->teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya ?? old('teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_gorvoda_rashetnyi" label="Расход теплоносителя, т/ч — горячее водоснабжение расчетный" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_gorvoda_rashetnyi ?? old('raskhod_teplonositelya_gorvoda_rashetnyi') ?? '0' }}" />
        <x-form.input name="raskhod_teplonositelya_gorvoda_srednechasovoy" label="Расход теплоносителя, т/ч — горячее водоснабжение среднечасовой" type="number" step="0.01" :required="true" value="{{ $item->raskhod_teplonositelya_gorvoda_srednechasovoy ?? old('raskhod_teplonositelya_gorvoda_srednechasovoy') ?? '0' }}" />
    </div>

    <h3>Параметры теплоносителя</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="heat_pressure" label="Давление теплоносителя, м вод. ст" type="number" step="0.01" :required="true" value="{{ $item->heat_pressure ?? old('heat_pressure') ?? '0' }}" />
        <x-form.input name="heat_temperature" label="Температура теплоносителя, °C" type="number" step="0.01" :required="true" value="{{ $item->heat_temperature ?? old('heat_temperature') ?? '0' }}" />
        <x-form.select name="consumption_mode" label="Режим потребления" :required="true" :list="['постоянный','переменный']" :value="$item->consumption_mode ?? old('consumption_mode') ?? 'постоянный'" />
        <x-form.input name="reliability_category" label="Категория надежности" :required="true" value="{{ $item->reliability_category ?? old('reliability_category')}}" />
    </div>

    <div class="columns-box columns-box--two-col">
        <x-form.select-key name="has_meter_control" label="Наличие узла учета тепловой энергии и теплоносителя" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->has_meter_control ?? old('has_meter_control') ?? 0" />
        <x-form.select-key name="has_own_source" label="Наличие собственной источника тепловой энергии" :required="false" :list="['Нет'=>0,'Да'=>1]" :value="$item->has_own_source ?? old('has_own_source') ?? 0" />
    </div>

    <h3>Дополнительная информация</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="commissioning_year" label="Год ввода в эксплуатацию" type="number" min="1900" max="2100" :required="false" value="{{ $item->commissioning_year ?? old('commissioning_year')  }}" />
        <x-form.input name="land_usage_info" label="Информация о виде разрешенного использования земельного участка" :required="false" value="{{ $item->land_usage_info ?? old('land_usage_info') }}" />
        <x-form.input name="construction_limits" label="Информация о предельных параметрах разрешённого строительства" :required="false" value="{{ $item->construction_limits ?? old('construction_limits') }}" />
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
    @endif

    <h3>Приложения</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="attachments_list" label="Количество приложенных листов" type="number" min="0" :required="false" value="{{ $item->attachments_list ?? old('attachments_list') }}" />
        <x-form.input name="attachments_ekz" label="Количество экземпляров" type="number" min="0" :required="false" value="{{ $item->attachments_ekz ?? old('attachments_ekz') }}" />
    </div>
    {{-- Конец формы --}}


    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
    <x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>
</form>

