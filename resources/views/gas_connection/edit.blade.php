@extends('layouts.all')

@php
    $title = "Редактировать: ". ($document_type->short_name ?? $document_type->name) ." № ".$item->id;
    $description = "Редактировать: ".$document_type->name." № ".$item->id;
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <div class="inner">
        <x-breadcrumbs
            :title="$title"
            :sub="$document_type->index_url"
            subtitle="Мои заявления"
        ></x-breadcrumbs>
        <h1>{{ $title }}</h1>

        <x-goskey.sign-document :document="$item"></x-goskey.sign-document>

        <x-organization-report :item="$item"></x-organization-report>

        <x-document-forms.gas-connection format="edit" :document-type="$document_type"></x-document-forms.gas-connection>

    </div>
@endsection
