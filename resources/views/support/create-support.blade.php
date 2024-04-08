@extends('layouts.all')

@php
    $title = "Создание заявления на государственную поддержку";
    $description = "Создание заявления на государственную поддержку. Создайте заявление и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Заявление на государственную поддержку"
                sub="{{ route('support') }}"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <p>Страница в разработке</p>
        </div>
    </section>


@endsection
