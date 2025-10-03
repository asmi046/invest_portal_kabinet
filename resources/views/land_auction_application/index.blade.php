@extends('layouts.all')

@php
    $title = $document_type->short_name ?? $document_type->name ?? "Мои заявления";
    $description = $document_type->name;
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs title="{{ $title }}"></x-breadcrumbs>
            <h1>{{ $document_type->short_name ?? $document_type->name }}</h1>
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ $document_type->create_url }}"
                    lnktxt="Создать заявление"
                    status="Проекты"
                    :value="$state['Всего']"
                    title="Всего проектов"
                    icon="briefcase-icon"
                ></x-widget-green-stat>


                <div class="columns-box__right-col">
                    @isset($state['Черновик'])
                        <x-widget-stat
                            :value="$state['Черновик']"
                            title="проектов в статусе черновик"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset

                    @isset($state['Отправлено на рассмотрение'])
                        <x-widget-stat
                            :value="$state['Отправлено на рассмотрение']"
                            title="проектов в статусе отправлено на рассмотрение"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset

                    @isset($state['Принят'])
                        <x-widget-stat
                            :value="$state['Принят']"
                            title="проектов в статусе принят"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset
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
                                    <th>Тип подписи</th>
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
                                            <x-document-table.sign-cell :item="$item"></x-document-table.sign-cell>
                                        </td>
                                        <td>
                                            <x-document-table.sign-type-cell :item="$item"></x-document-table.sign-type-cell>
                                        </td>
                                        <td>{{ $item->state }}</td>
                                        <td>
                                            <x-document-table.control-cell :item="$item" :route-name="'area_get'"></x-document-table.control-cell>
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
