@extends('layouts.all')

@php
    $title = "Создание заявления на предоставление земельного участка";
    $description = "Создание заявления на предоставление земельного участка";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')


    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Создание заявления на предоставление земельного участка"
                sub="{{ route('area_get') }}"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <x-area-get.edit-form format="create" action="{{route('area_get_save')}}"></x-area-get.edit-form>
        </div>
    </section>

@endsection
