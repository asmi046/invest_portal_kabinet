@extends('layouts.all')

@php
    $title = "Мои заявления на государственную поддержку";
    $description = "Мои заявления на государственную поддержку дашборд";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs title="Мои заявления на государственную поддержку"></x-breadcrumbs>
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ route('project_create') }}"
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
                    title="заявления в обрабботке"
                    icon="analytics-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['Предоставлен ответ']"
                    title="заявления с полученным ответом"
                    icon="doccheck-icon"
                    ></x-widget-stat>
                </div>
            </div>

                @if ($supports->count() > 0)
                    <div class="table-box">
                        <table class="w-table applications-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название проекта</th>
                                    <th>Объем инвестиций</th>
                                    <th>Территория реализации</th>
                                    <th>Статус</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supports as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->invest_volume }} млн. руб.</td>
                                        <td>{{ $item->relis_area}}</td>
                                        <td>{{ $item->state }}</td>
                                        <td>
                                            <a href="{{route('support_print', $item->id)}}">Печатная форма</a>
                                            <a href="{{route('support_signe', $item->id)}}">Подписать</a>
                                            <a href="{{route('support_edit', $item->id)}}">Редактировать</a>
                                            <a href="{{route('support_status', $item->id)}}">Статус</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <h2>У вас еще нет проектов</h2>
                    <a href="{{ route('project_create') }}" class="button">Создать инвестпроект</a>
                @endif


            @if ($supports->count() > 0)
                <x-pagination :tovars="$supports"></x-pagination>
            @endif


        </div>
    </section>
@endsection
