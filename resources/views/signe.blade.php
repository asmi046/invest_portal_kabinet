@extends('layouts.all')

@php
    $title = "Подписать документ";
    $description = "Подписать документ";
@endphp

@section('title', $title)
@section('description', $description)
@section('body')

    <script language="javascript" src="{{asset('js/cadesplugin_api.js')}}"></script>
    <script language="javascript" src="{{asset('js/sign.js')}}"></script>
    <section class="my-project-section">
        <div class="inner">
            <h1>{{ $title }}</h1>

            <div class="columns-box columns-box--two-col">
                <div class="file_info">
                    Имя файла: <strong><a href="{{ config('app.url')."/".$file->storage_patch."/".$file->file }}">{{ $file->file_real }}</a></strong>
                    <br>
                    Тип документа: <strong>{{ $file->inner_document_type }}</strong>
                </div>
                <div class="sert_list">

                    <form id="cert_form" action="">
                        <input type="hidden" id="file_lnk" name="file_lnk" value="{{ config('app.url')."/".$file->storage_patch."/".$file->file }}">
                        <input type="hidden" id="signe_id" name="signe_id" value="{{ $file->id }}">

                        <select size="6" name="cert_id" id="cert_list">

                        </select>
                        <button id="do_signe" class="btn">Подписать</button>
                        <a id="linkNode" href=""></a>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
