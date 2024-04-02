@extends('layouts.all')

@php
    $title = "Заявление на техническое присоединение";
    $description = "Заявление на техническое присоединение";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Подать заявление на техническое присоединение"
                sub="{{ route('technical_connect') }}"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <x-tc.edit-form format="create"></x-tc.edit-form>

        </div>
    </section>


@endsection
