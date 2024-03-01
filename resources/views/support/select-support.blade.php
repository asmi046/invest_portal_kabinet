@extends('layouts.all')

@php
    $title = "Подать заявление на государственную поддержку";
    $description = "Выберите тип государственной поддержки";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <div class="application-catalog-page">
        <div class="inner">
            <ul class="breadcrumbs">
                <li>
                    <a href="#">Главная</a>
                    <i>/</i>
                </li>
                <li>
                    <span>Подать заявление на государственную поддержку</span>
                </li>
            </ul>
            <h1>Подать заявление на государственную поддержку</h1>
            <div class="columns-box columns-box--two-col application-catalog">
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Льготы по налогу на имущество</span>
                    <span class="btn-link__icon house-icon"></span>
                </a>
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Льготы по налогу на прибыль</span>
                    <span class="btn-link__icon money-icon"></span>
                </a>
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Льготы по налогу на транспорт</span>
                    <span class="btn-link__icon car-icon"></span>
                </a>
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Льготы по налогу на землю</span>
                    <span class="btn-link__icon way-icon"></span>
                </a>
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Предоставление земельных участков без торгов</span>
                    <span class="btn-link__icon map-icon"></span>
                </a>
                <a href="{{ route('support_create') }}" class="btn-link">
                    <span class="btn-link__text">Субсидии инвесторам</span>
                    <span class="btn-link__icon extradition-icon"></span>
                </a>
            </div>
        </div>
    </div>
@endsection
