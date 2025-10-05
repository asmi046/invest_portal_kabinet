@extends('layouts.all')

@php
    $title = "Создать: ". ($document_type->short_name ?? $document_type->name ?? "Мои заявления");
    $description = "Создать: ".$document_type->name;
@endphp

@section('title', $title)
@section('description', $description)

@section('body')


    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                :title="$title"
                :sub="$document_type->index_url"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>
            <x-goskey.sign-document></x-goskey.sign-document>

            <x-document-forms.gas_connection format="create" action="#"></x-document-forms.gas_connection>

        </div>
    </section>

@endsection
