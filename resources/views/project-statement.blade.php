@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
     <section class="statement-section">
        <div class="inner">
            <x-breadcrumbs
                sub="{{route('projects')}}"
                subtitle="Мои инвестиционные проекты"
                title="Статус проекта"
            ></x-breadcrumbs>

            <h1>Заявление № 1</h1>
            <p>
                Заявка/заявление на рассмотрении в ПАО РОССЕТИ, тел.: 8 (471) 255-73-59
            </p>
            <div class="stages-box">
                <h2 class="section-title">Этап рассмотрения:</h2>
                <ul class="stages">
                    <li class="stages-item stages-item--passed">
                        <div class="stages-item__marker"></div>
                        <div class="stages-item__text">Подача заявления</div>
                    </li>
                    <li class="stages-item stages-item--current">
                        <div class="stages-item__marker"></div>
                        <div class="stages-item__text">
                            Выдача и подписание договора  о технологическом присоединении и договора электроснабжения
                        </div>
                    </li>
                    <li class="stages-item">
                        <div class="stages-item__marker"></div>
                        <div class="stages-item__text">
                            Выполнение строительных работ и окончательное подключение
                        </div>
                    </li>
                    <li class="stages-item">
                        <div class="stages-item__marker"></div>
                        <div class="stages-item__text">
                            Выполнение строительных работ и окончательное подключение
                        </div>
                    </li>
                    <li class="stages-item">
                        <div class="stages-item__marker"></div>
                        <div class="stages-item__text">
                            Выполнение строительных работ и окончательное подключение
                        </div>
                    </li>
                </ul>
            </div>
            <h2 class="section-title">Срок рассмотрения:</h2>
            <p>
                Срок рассмотрения 10 рабочих дней
            </p>
        </div>
     </section>
@endsection
