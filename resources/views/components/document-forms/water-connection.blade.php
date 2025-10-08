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

    <h3>Организация осуществляющая подключение</h3>


    <x-form.input name="supplier_org" label="Наименование организации, осуществляющей холодное водоснабжение и (или) водоотведение" :required="false" value="{{ $item->supplier_org ?? old('supplier_org') }}" />

    <h3>Информациф о заявителе</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="applicant_name" label="Организация или Ф.И.О. заявителя" :required="false" value="{{ $item->applicant_name ?? old('applicant_name') ?? get_fio_str() }}" />
        <x-form.input name="address" label="Адрес" :required="false" value="{{ $item->address ?? old('address') }}" />

        <x-form.input name="phone" label="Телефон" :required="false" value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone}}" />

        <x-form.input name="email" label="Адрес электронной почты" :required="false" value="{{ $item->email ?? old('email') ?? auth()->user()->email }}" />
    </div>

    <h3>Информациф об объекте подключения</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="object_name" label="Наименование объекта капитального строительства" :required="false" value="{{ $item->object_name ?? old('object_name') }}" />
        <x-form.input name="object_address" label="Адрес объекта" :required="false" value="{{ $item->object_address ?? old('object_address') }}" />
    </div>
    <x-form.textarea name="object_description" label="Краткая характеристика объекта" :required="false" value="{{ $item->object_description ?? old('object_description') }}" />

    <h3>Планируемая подключаемая нагрузка объекта:</h3>

    <div class="columns-box columns-box--two-col">
        <x-form.input name="payload_all_snab" label="Общая нагрузка на водоснабжение, м3/сут" :required="false" value="{{ $item->payload_all_snab ?? old('payload_all_snab') ?? '0' }}" />
        <x-form.input name="payload_all_ot" label="Общая нагрузка на водоотведение, м3/час" :required="false" value="{{ $item->payload_all_ot ?? old('payload_all_ot') ?? '0' }}" />

        <x-form.input name="payload_hoz_snab" label="Нагрузка на хозяйственные нужды на водоснабжение, м3/сут" :required="false" value="{{ $item->payload_hoz_snab ?? old('payload_hoz_snab') ?? '0' }}" />
        <x-form.input name="payload_hoz_ot" label="Нагрузка на хозяйственные нужды  на водоотведение, м3/час" :required="false" value="{{ $item->payload_hoz_ot ?? old('payload_hoz_ot') ?? '0' }}" />

        <x-form.input name="payload_prom_snab" label="Нагрузка на производственные нужды на водоснабжение, м3/сут" :required="false" value="{{ $item->payload_prom_snab ?? old('payload_prom_snab') ?? '0' }}" />
        <x-form.input name="payload_prom_ot" label="Нагрузка на производственные нужды на водоотведение, м3/час" :required="false" value="{{ $item->payload_prom_ot ?? old('payload_prom_ot') ?? '0' }}" />

        <x-form.input name="payload_fire_snab" label="Нагрузка на пожарные нужды на водоснабжение, л/сек" :required="false" value="{{ $item->payload_fire_snab ?? old('payload_fire_snab') ?? '0' }}" />
        <x-form.input name="payload_fire_ot" label="Нагрузка на пожарные нужды на водоотведение, л/сек" :required="false" value="{{ $item->payload_fire_ot ?? old('payload_fire_ot') ?? '0' }}" />
    </div>

    <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control>
</form>

