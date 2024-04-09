@extends('layouts.all')

@php
    $title = "Список ресурсоснабжающих организаций";
    $description = "Список ресурсоснабжающих организаций";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')

    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Список ресурсоснабжающих организаций"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            @foreach ($organization as $item)
                <x-contacts.text-card :item="$item"></x-contacts.text-card>
            @endforeach
        </div>
    </section>


@endsection
