@extends('layouts.all')

@php
    $title = "Мои инвестиционные проекты";
    $description = "Мои инвестиционные проекты дашборд";
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
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ route('technical_connect_create') }}"
                    lnktxt="Создать проект"
                    status="Проекты"
                    :value="$state['Всего']"
                    title="Всего проектов"
                    icon="briefcase-icon"
                ></x-widget-green-stat>


                <div class="columns-box__right-col">
                    <x-widget-stat
                    :value="$state['Черновик']"
                    title="проектов в статусе черновик"
                    icon="two-docs-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['В обработке']"
                    title="проекта в обрабботке"
                    icon="analytics-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['Предоставлен ответ']"
                    title="проекта с полученным ответом"
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
                                    <th>Название проекта</th>
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
                                            <a href="{{route('technical_connect_signe', $item->id)}}">Подписать</a>
                                            <a href="{{route('technical_connect_edit', $item->id)}}">Редактировать</a>
                                            <a href="{{route('technical_connect_status', $item->id)}}">Статус</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <h2>У вас еще нет заявлений</h2>
                    <a href="{{ route('project_create') }}" class="button">Создать заявление</a>
                @endif


            @if ($tc->count() > 0)
                <x-pagination :tovars="$tc"></x-pagination>
            @endif


        </div>
    </section>
@endsection
