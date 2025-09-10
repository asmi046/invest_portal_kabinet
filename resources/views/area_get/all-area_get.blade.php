@extends('layouts.all')

@php
    $title = "Мои заявления на предоставление земельного участка";
    $description = "Мои заявления на предоставление земельного участка";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs title="Мои заявления на предоставление земельного участка"></x-breadcrumbs>
            <h1>Заявления на предоставление земельного участка</h1>
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ route('area_get_create') }}"
                    lnktxt="Создать заявление"
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
                    title="проекта в обработке"
                    icon="analytics-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    :value="$state['Предоставлен ответ']"
                    title="проекта с полученным ответом"
                    icon="doccheck-icon"
                    ></x-widget-stat>
                </div>
            </div>

                @if ($areas->count() > 0)
                    <div class="table-box">
                        <table class="w-table applications-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Объект</th>
                                    <th>Тип объекта</th>
                                    <th>Подпись</th>
                                    <th>Статус</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->object_name }}</td>
                                        <td>{{ $item->object_type }}</td>
                                        <td>
                                            @if ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->status_code == 100)
                                                <div @class(['signed_blk'])> <span class="icon sign2-icon"></span> Подписан</div>
                                            @endif

                                            @if ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->error_code == -100)
                                                <div @class(['signed_blk', 'error_sig'])> <span class="icon sign2-icon"></span> Отказ</div>
                                            @elseif  ($item->goskeyRegistries && isset($item->goskeyRegistries[0]) && $item->goskeyRegistries[0]->error_code != null)
                                                <div @class(['signed_blk', 'error_sig'])> <span class="icon sign2-icon"></span> Ошибка</div>
                                            @endif

                                        </td>
                                        <td>{{ $item->state }}</td>
                                        <td>
                                            <a href="{{route('area_get_print', $item->id)}}">Печатная форма</a>
                                            @if (!in_array($item->state, config('documents')['area_get']['statuses_noedit']))
                                                <a href="{{route('area_get_edit', $item->id)}}">Редактировать</a>
                                            @else
                                                <a href="{{route('area_get_edit', $item->id)}}">Посмотреть</a>
                                            @endif
                                            <a href="{{route('area_get_status', $item->id)}}">Статус</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                @else
                    <h2>У вас еще нет заявлений</h2>
                    <a href="{{ route('area_get_create') }}" class="button">Создать заявление</a>
                @endif


            @if ($areas->count() > 0)
                <x-pagination :tovars="$areas"></x-pagination>
            @endif


        </div>
    </section>
@endsection
