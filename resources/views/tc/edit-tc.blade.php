@extends('layouts.all')

@php
    $title = "Редактирование заявления на техническое присоединение";
    $description = "Редактирование заявления на техническое присоединение";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                :title="'Редактировать заявление на техническое присоединение'.$item->id"
                sub="{{ route('technical_connect') }}"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>Редактирование заявления на техническое присоединение №{{ $item->id }}</h1>

            <x-tc.edit-form :item="$item" format="edit" :action="route('technical_connect_save')"></x-tc.edit-form>
        </div>
    </section>


@endsection
