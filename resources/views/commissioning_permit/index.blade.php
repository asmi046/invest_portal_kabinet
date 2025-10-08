@extends('layouts.all')

@php
    $title = $document_type->short_name ?? $document_type->name ?? "Мои заявления";
    $description = $document_type->name;
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs title="{{ $title }}"></x-breadcrumbs>
            <h1>{{ $document_type->short_name ?? $document_type->name }}</h1>

            <x-document-table.stat :state="$state" :document-type="$document_type"></x-document-table.stat>

            <x-document-table :elements="$elements" :document-type="$document_type"></x-document-table>

            @if ($elements->count() > 0)
                <x-pagination :tovars="$elements"></x-pagination>
            @endif
        </div>
    </section>
@endsection
