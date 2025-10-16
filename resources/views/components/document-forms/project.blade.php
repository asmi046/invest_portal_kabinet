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

    {{-- Конец формы --}}

    {{-- <x-form.main-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.main-control> --}}
    <x-form.blocked-control :format="$format" :item="$item ?? null" :document-type="$documentType" ></x-form.blocked-control>

</form>

