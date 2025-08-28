@extends('layouts.all')

@php
    $title = "Личный кабинет - Инвестиционный портал Курской Области";
    $description = "Личный кабинет - Инвестиционный портал Курской Области";
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
                В личном кабинете Инвестора доступны функции подачи заявок:
            </p>
            <ol>
                <li>На сопровождение проекта по принципу «Одно окно»</li>
                <li>На получение государственной поддержки</li>
                <li>На получение доступа к ключевым элементам инфраструктуры согласно своду инвестиционных правил</li>
            </ol>

            <div class="btn-link-box columns-box">
                <div class="btn-link goskey_banner">
                    <div class="logo_wrappe">
                        <img src="{{ asset('img/goskey-vertical-logo.svg')}}" alt="Подписание при помощи Госключа">
                    </div>
                    <div class="text_wrappe">
                        <h2>Подписывайте документы при помощи МП Госключ</h2>
                        <p>Приложение Госключ позволяет бесплатно получить сертификат электронной подписи и подписывать документы.</p>
                        <p>В нашем личном кабинете Вы можете подписать все запросы при помощи мобильного приложения Госключь.</p>
                        <div class="mobile_store">
                            <a href="https://apps.rustore.ru/app/ru.gosuslugi.goskey">
                                <img src="{{ asset('img/mobile_store_icon/store_ru.svg') }}" alt="Скачать Госключ с RuStore">
                            </a>
                            <a href="https://appgallery.huawei.com/#/app/C104297607">
                                <img src="{{ asset('img/mobile_store_icon/store_gallery.svg') }}" alt="Скачать Госключ с AppGalery">
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=ru.gosuslugi.goskey">
                                <img src="{{ asset('img/mobile_store_icon/store_play.svg') }}" alt="Скачать Госключ с Google Play">
                            </a>
                            <a href="https://apps.apple.com/ru/app/id1566096745">
                                <img src="{{ asset('img/mobile_store_icon/store_apple.svg') }}" alt="Скачать Госключ с App Store">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-link-box columns-box columns-box--two-col">
                <x-widget-icon-lnk lnk="{{ route('project_create') }}" title="Подать заявление на государственную поддержку" icon="building-icon"></x-widget-icon-lnk>
                <x-widget-icon-lnk lnk="{{ route('support_select') }}" title="Заявления на государственную поддержку" icon="laptop-icon"></x-widget-icon-lnk>
                <x-widget-icon-lnk lnk="{{ route('technical_connect_create') }}" title="Заявления на технологическое присоединение" icon="tablet-icon"></x-widget-icon-lnk>
            </div>


            <h2 class="h3">Мои заявки и проекты</h2>
            <div class="iportal-card-box columns-box columns-box--two-col">
                @if ($last_project)
                    <x-widget-green
                        lnk="{{ route('project_status', $last_project->id) }}"
                        lnktxt="Просмотреть статус"
                        status="{{$last_project->state}}"
                        title="{{$last_project->name}}"
                        icon="check-list-icon"
                    ></x-widget-green>
                @else
                <x-widget-green
                    lnk="{{ route('project_create') }}"
                    lnktxt="Создать проект"
                    status="Новый проект"
                    title="Создайте новый инвестиционный проект и отправьте его на рассмотрение"
                    icon="check-list-icon"
                ></x-widget-green>
                @endif

                @if ($last_ts)
                    <x-widget-green
                        lnk="{{ route('technical_connect_status', $last_ts->id) }}"
                        lnktxt="Просмотреть статус"
                        status="{{$last_ts->state}}"
                        title="{{$last_ts->name}}"
                        icon="check-list-icon"
                    ></x-widget-green>
                @else
                    @if ($last_support)
                        <x-widget-green
                            lnk="{{ route('support_status', $last_support->id) }}"
                            lnktxt="Просмотреть статус"
                            status="{{$last_support->state}}"
                            title="{{$last_support->name}}"
                            icon="check-list-icon"
                        ></x-widget-green>
                    @endif
                @endif

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

                    @foreach ($docs as $key => $value)
                        <h4>{{ $key }}</h4>
                        <div class="columns-box columns-box--two-col">
                            @foreach ($value as $item)
                                <x-widget-file
                                :lnk="Storage::url('portal_documents/'.$item->file)"
                                :title="$item->title"
                                ></x-widget-file>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection
