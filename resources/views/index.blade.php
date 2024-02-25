@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="main-page-section">
        <div class="inner">
            <ul class="breadcrumbs">
                <li>
                    <a href="#">Главная</a>
                    <i>/</i>
                </li>
                <li>
                    <span>Главная</span>
                </li>
            </ul>
            <h1>Добро пожаловать в Личный кабинет Инвестора!</h1>
            <p>
                <a href="{{route('logout')}}">Выйти</a>
            </p>
            <p>
                В личном кабинете Инвестора доступны функции подачи заявок:
            </p>
            <ol>
                <li>На сопровождение проекта по принципу «Одно окно»</li>
                <li>На получение государственной поддержки</li>
                <li>На получение доступа к ключевым элементам инфраструктуры согласно своду инвестиционных правил</li>
            </ol>

            <div class="btn-link-box columns-box columns-box--two-col">
                <x-widget-icon-lnk lnk="#" title="Подать заявление на государственную поддержку" icon="building-icon"></x-widget-icon-lnk>
                <x-widget-icon-lnk lnk="#" title="Подать заявление на сопровождение проекта по принципу «Одно окно»" icon="laptop-icon"></x-widget-icon-lnk>
                <x-widget-icon-lnk lnk="#" title="Подать заявление на получение доступа к ключевым элементам инфраструктуры согласно своду инвестиционных правил" icon="tablet-icon"></x-widget-icon-lnk>
            </div>


            <h2 class="h3">Мои заявки и проекты</h2>
            <div class="iportal-card-box columns-box columns-box--two-col">
                <x-widget-green
                    lnk="#"
                    lnktxt="Подать проект"
                    status="Черновик"
                    title="Инвестиционный проект №1 от 21.11.2023"
                    icon="check-list-icon"
                ></x-widget-green>

                <x-widget-green
                    lnk="#"
                    lnktxt="Мои заявления"
                    status="Черновик"
                    title="Заявление ООО “Энергосбыт” на государственную поддержку от 21.11.2023"
                    icon="check-list-icon"
                ></x-widget-green>
            </div>

            <div class="ip-tab">
                <div class="ip-tab-controller">
                    <button class="ip-tab-controller__btn active">Видеоинструкции</button>
                    <button class="ip-tab-controller__btn">Нормативно-правовая база для Инвестора</button>
                </div>
                <div class="ip-tab__display active">
                    <div class="columns-box columns-box--two-col">
                        <div class="video-box">
                            {{-- <iframe src="https://www.youtube.com/embed/94-KCPOxd2Y?si=Cvt3hL7NKihOVJFG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>  --}}
                            <video  poster="{{asset('img/poster-1.jpg')}}">
                                <source src="{{asset('video/heli-video.mp4')}}" type="video/mp4">
                            </video>
                            <button type="button" class="video-box__video-play"></button>
                        </div>
                        <div class="video-box">
                            {{-- <iframe  src="https://www.youtube.com/embed/94-KCPOxd2Y?si=Cvt3hL7NKihOVJFG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
                            <video  poster="{{asset('img/poster-2.jpg')}}">
                                <source src="{{asset('video/heli-video.mp4')}}" type="video/mp4">
                            </video>
                            <button type="button" class="video-box__video-play"></button>
                        </div>
                    </div>
                </div>
                <div class="ip-tab__display">
                    <h4>Законы Курской области</h4>
                    <div class="columns-box columns-box--two-col">
                        <x-widget-file
                        lnk="#"
                        title="Закон Курской области от 12.08.2004 N 37-ЗКО «Об инвестиционной деятельности в Курской области»"
                        ></x-widget-file>

                        <x-widget-file
                        lnk="#"
                        title="Закон Курской области от 22.06.2015 № 58-ЗКО «Об установлении критериев, которым должны соответствовать объекты социально-культурного и коммунально-бытового назначения, масштабные инвестиционные проекты, для размещения (реализации) которых допускается предоставление земельных участков в аренду без проведения торгов»"
                        ></x-widget-file>
                    </div>

                    <h4>Примерная форма бизнес-плана инвестиционного проекта</h4>
                    <div class="columns-box columns-box--two-col">
                        <x-widget-file
                        lnk="#"
                        title="Распоряжение Правительства Курской области от 8 февраля 2008 г. N 53-р"
                        ></x-widget-file>
                    </div>
                    <h4>Приказы</h4>
                    <div class="columns-box columns-box--two-col">

                        <x-widget-file
                        lnk="#"
                        title="Приказ комитета по экономике и развитию Курской области от 21.04.2015 № 8-а «Об утверждении методики расчета показателей абсолютной и относительной финансовой устойчивости, которым должны соответствовать коммерческие организации, претендующие на предоставление ..."
                        ></x-widget-file>

                        <x-widget-file
                        lnk="#"
                        title="Приказ комитета по экономике и развитию Курской области от 20.10.2015 № 75-о «Об утверждении форм документов, предоставляемых инвесторами на вхождение в режим наибольшего благоприятствования или реализующих инвестиционные проекты в режиме ..."
                        ></x-widget-file>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
