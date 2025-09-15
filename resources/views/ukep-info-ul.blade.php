@extends('layouts.all')

@php
    $title = "Как юридическим лицам подписать документ с помощью Госключа?";
    $description = "Инструкция по подписанию документов с помощью Госключа для юридических лиц";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')

    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Как юридическим лицам подписать документ с помощью Госключа?"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <div class="text_styles">
                <p>Руководители коммерческих организаций и&nbsp;ИП могут получить сертификат усиленной квалифицированной электронной подписи&nbsp;(УКЭП) для приложения «Госключ» в&nbsp;удостоверяющем центре ФНС&nbsp;(УЦ&nbsp;ФНС)</p>

                <p>Если организация получает средства из&nbsp;госбюджета, нужно <a href="https://www.gosuslugi.ru/help/faq/state_key/174590789">оформить сертификат УКЭП</a> удостоверяющего центра Казначейства России для «Госключа»</p>

                <h5>Что нужно для получения сертификата УКЭП в УЦ ФНС</h5>
                <ul>
                <li><a href="https://www.gosuslugi.ru/help/faq/login/2">Подтверждённая учётная запись</a> на&nbsp;Госуслугах и&nbsp;указанные данные СНИЛС и&nbsp;ИНН <a href="https://lk.gosuslugi.ru/profile/personal">в&nbsp;личном кабинете</a></li>
                <li><a href="https://lk.gosuslugi.ru/settings/account">Номер телефона</a>, привязанный к&nbsp;учётной записи,&nbsp;— при регистрации на&nbsp;него придёт смс с&nbsp;кодом активации</li>
                <li>Подтверждение личности в&nbsp;УЦ&nbsp;ФНС</li>
                </ul>

                <h5>Как получить</h5>
                <ol>
                <li>Скачайте приложение «Госключ» <a href="https://www.rustore.ru/catalog/app/ru.gosuslugi.goskey" target="_blank">в&nbsp;RuStore</a>, <a href="https://play.google.com/store/apps/details?id=ru.gosuslugi.goskey" target="_blank">Google Play</a>, <a href="https://apps.apple.com/ru/app/id1566096745" target="_blank">App Store</a> или <a href="https://appgallery.huawei.com/#/app/C104297607" target="_blank">AppGallery</a></li>
                <li>Зарегистрируйтесь и примите правила сервиса</li>
                <li><a href="https://www.gosuslugi.ru/help/faq/state_key/55502">Оформите сертификат</a> усиленной неквалифицированной электронной подписи&nbsp;(УНЭП), следуя подсказкам на экране</li>
                <li>Инициируйте получение сертификата УКЭП в&nbsp;самом приложении. Для этого на&nbsp;главном экране в&nbsp;правом верхнем углу приложения перейдите в&nbsp;настройки&nbsp;→ Получить сертификат УКЭП&nbsp;ЮЛ или ИП</li>
                <li><a href="https://www.nalog.gov.ru/rn77/related_activities/ucfns/" target="_blank">Посетите УЦ&nbsp;ФНС</a> и получите сертификат УКЭП. Понадобятся:
                <ul>
                <li>паспорт&nbsp;РФ</li>
                <li>СНИЛС</li>
                <li>ИНН</li>
                </ul>
                </li>
                </ol>
            </div>

            <div class="link">
                <a class="btn btn--green" href="https://www.gosuslugi.ru/help/faq/state_key/174590790" target="_blank">Подробнее на Госуслугах</a>
                <br>
                <a class="btn btn--green" href="https://www.nalog.gov.ru/rn77/related_activities/ucfns/" target="_blank">Удостоверяющий центр ФНС России</a>
            </div>
        </div>
    </section>


@endsection
