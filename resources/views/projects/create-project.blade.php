@extends('layouts.all')

@php
    $title = "Создание инвестиционного проекта";
    $description = "Создание инвестиционного проекта. Создайте проект и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Инвестиционный проект"
                sub="{{ route('projects') }}"
                subtitle="Мои проекты"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <p>Страница в разработке</p>
        </div>
    </section>


@endsection
