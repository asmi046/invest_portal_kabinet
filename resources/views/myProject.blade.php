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
            <ul class="breadcrumbs">
                <li>
                    <a href="#">Главная</a>
                    <i>/</i>
                </li>
                <li>
                    <a href="#">Заявить инвестиционный проект</a>
                    <i>/</i>
                </li>
                <li>
                    <span>Мои проекты</span>
                </li>
            </ul>
            <div class="columns-box columns-box--two-col project-panel">
                <div class="columns-box__left-col">
                    <div class="iportal-card">
                        <span class="iportal-card__icon briefcase-icon"></span>
                        <span class="iportal-card__status-marker">
                            Черновик
                        </span>
                        <span class="iportal-card__caption">
                            <span class="iportal-card__big-text">10</span>
                            Всего проектов
                        </span>
                        <a href="#" class="iportal-card__btn">Добавить</a>
                        {{-- <button href="#" class="iportal-card__btn">Подать проект</button> --}}
                    </div>
                </div>
                <div class="columns-box__right-col">
                    <div class="btn-link">
                        <span class="btn-link__number">5</span>
                        <span class="btn-link__text">проектов в статусе черновик</span>
                        <span class="btn-link__icon two-docs-icon"></span>
                    </div>
                    <div class="btn-link">
                        <span class="btn-link__number">3</span>
                        <span class="btn-link__text">проекта на модерации</span>
                        <span class="btn-link__icon analytics-icon"></span>
                    </div>
                    <div class="btn-link">
                        <span class="btn-link__number">2</span>
                        <span class="btn-link__text">действующих проекта</span>
                        <span class="btn-link__icon doccheck-icon"></span>
                    </div>
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
                            <td><a href="{{route('statement')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>На модерации</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="{{route('statement')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>Черновик</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="{{route('statement')}}">Заявление на технологическое присоединение</a></td>
                            <td>50 млн. руб.</td>
                            <td>Курская область</td>
                            <td>Черновик</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="{{route('statement')}}">Заявление на подачу заявления на государственную поддержку</a></td>
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
