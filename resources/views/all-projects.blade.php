@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs title="Мои инвестиционные проекты"></x-breadcrumbs>
            <div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="#"
                    lnktxt="Создать проект"
                    status="Черновик"
                    value="0"
                    title="Всего проектов"
                    icon="briefcase-icon"
                ></x-widget-green-stat>


                <div class="columns-box__right-col">
                    <x-widget-stat
                    value="0"
                    title="проектов в статусе черновик"
                    icon="two-docs-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    value="0"
                    title="проекта на модерации"
                    icon="analytics-icon"
                    ></x-widget-stat>

                    <x-widget-stat
                    value="0"
                    title="действующих проекта"
                    icon="doccheck-icon"
                    ></x-widget-stat>
                </div>
            </div>
            <div class="table-box">
                <table class="w-table applications-table">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Название проекта</th>
                            <th>Объем инвестиций</th>
                            <th>Территория реализации</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="{{route('project_status')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>На модерации</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="{{route('project_status')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>Черновик</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="{{route('project_status')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>Черновик</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="{{route('project_status')}}">Заявление на подачу заявления на государственную поддержку</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>Черновик</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <ul class="paginations">
                <li>
                    <span class="paginations-arrow paginations-arrow--all-prev"></span>
                </li>
                <li>
                    <span class="paginations-arrow paginations-arrow--prev"></span>
                </li>
                <li>
                    <a href="#" class="active">1</a>
                </li>
                <li>
                    <a href="#">2</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
                <li>
                    <a href="#">4</a>
                </li>
                <li>
                    <span>...</span>
                </li>
                <li>
                    <a href="#">7</a>
                </li>
                <li>
                    <a href="#" class="paginations-arrow paginations-arrow--next"></a>
                </li>
                <li>
                    <a href="#" class="paginations-arrow paginations-arrow--all-next"></a>
                </li>
            </ul>
        </div>
    </section>
@endsection
