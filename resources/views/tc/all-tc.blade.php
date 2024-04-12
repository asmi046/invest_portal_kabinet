@extends('layouts.all')

@php
    $title = "Мои заявления технологическое присоединение";
    $description = "Заявления технологическое присоединение";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            @if (session('deleted'))
                <p class="success">{{ session('deleted') }}</p>
            @endif
            <x-breadcrumbs title="Мои заявления на техническое присоединение"></x-breadcrumbs>
            <h1>Заявления технологическое присоединение</h1>
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ route('technical_connect_create') }}"
                    lnktxt="Создать заявление"
                    status="Заявления"
                    :value="$state['Всего']"
                    title="Всего заявлений"
                    icon="briefcase-icon"
                ></x-widget-green-stat>


                <div class="columns-box__right-col">
                    <x-widget-stat
                    :value="$state['Черновик']"
                    title="заявлений в статусе черновик"
                    icon="two-docs-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['В обработке']"
                    title="заявлений в обработке"
                    icon="analytics-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['Предоставлен ответ']"
                    title="заявлений с полученным ответом"
                    icon="doccheck-icon"
                    ></x-widget-stat>
                </div>
            </div>

                @if ($tc->count() > 0)
                    <div class="table-box">
                        <table class="w-table applications-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Заявитель</th>
                                    <th>Требуемая мощьность (кВт)</th>
                                    <th>Поставщик</th>
                                    <th>Статус</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tc as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pover_pris_devices }}</td>
                                        <td>{{ $item->gen_postavhik}}</td>
                                        <td>{{ $item->state }}</td>
                                        <td>
                                            <a href="{{route('technical_connect_print', $item->id)}}">Печатная форма</a>
                                            @if (!in_array($item->state, config('documents')['tc']['statuses_noedit']))
                                                <a href="{{route('technical_connect_edit', $item->id)}}">Редактировать</a>
                                            @else
                                                <a href="{{route('technical_connect_edit', $item->id)}}">Посмотреть</a>
                                            @endif
                                            <a href="{{route('technical_connect_status', $item->id)}}">Статус</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <h2>У вас еще нет заявлений</h2>
                    <a href="{{ route('technical_connect_create') }}" class="button">Создать заявление</a>
                @endif


            @if ($tc->count() > 0)
                <x-pagination :tovars="$tc"></x-pagination>
            @endif


        </div>
    </section>
@endsection
