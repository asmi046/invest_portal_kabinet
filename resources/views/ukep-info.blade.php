@extends('layouts.all')

@php
    $title = "Как подписать документ с помощью Госключа?";
    $description = "Инструкция по подписанию документов с помощью Госключа";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')

    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Как подписать документ с помощью Госключа?"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <img class="ukep_instruction" src="{{ asset('img/goskey/ukep_way.webp')}}" alt="Инструкция по подписанию документов с помощью Госключа">
        </div>
    </section>


@endsection
