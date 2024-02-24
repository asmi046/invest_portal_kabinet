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
                <a href="#" class="btn-link">
                    <span class="btn-link__text">Подать заявление на государственную поддержку</span>
                    <span class="btn-link__icon building-icon"></span>
                </a>
                <a href="#" class="btn-link">
                    <span class="btn-link__text">Подать заявление на сопровождение проекта по принципу «Одно окно»</span>
                    <span class="btn-link__icon laptop-icon"></span>
                </a>
                <a href="#" class="btn-link">
                    <span class="btn-link__text">Подать заявление на получение доступа
                        к ключевым элементам инфраструктуры согласно своду инвестиционных правил</span>
                    <span class="btn-link__icon tablet-icon"></span>
                </a>
            </div>
            <h2 class="h3">Мои заявки и проекты</h2>
            <div class="iportal-card-box columns-box columns-box--two-col">
                <div class="iportal-card">
                    <span class="iportal-card__icon check-list-icon"></span>
                    <span class="iportal-card__status-marker">
                        Черновик
                    </span>
                    <span class="iportal-card__caption">
                        Инвестиционный проект №1 от 21.11.2023
                    </span>
                    <a href="#" class="iportal-card__btn">Подать проект</a>
                    {{-- <button href="#" class="iportal-card__btn">Подать проект</button> --}}
                </div>
                <div class="iportal-card">
                    <span class="iportal-card__icon check-list-icon"></span>
                    <span class="iportal-card__status-marker">
                        Черновик
                    </span>
                    <span class="iportal-card__caption">
                        Заявление ООО “Энергосбыт” на государственную поддержку
                        от 21.11.2023
                    </span>
                    <button  class="iportal-card__btn">Мои заявления</button>
                    {{-- <a href="#"  class="iportal-card__btn">Мои заявления</a> --}}
                </div>
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
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 12.08.2004 N 37-ЗКО «Об инвестиционной деятельности в Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 22.06.2015 № 58-ЗКО «Об установлении критериев, которым должны соответствовать объекты социально-культурного и коммунально-бытового назначения, масштабные инвестиционные проекты, для размещения (реализации) которых допускается предоставление земельных участков в аренду без проведения торгов»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 29.10.2013 № 101-ЗКО «Об инвестиционном фонде Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 14.12.2010 № 112-ЗКО «О понижении налоговой ставки налога на прибыль организаций, подлежащего зачислению в областной бюджет, для отдельных категорий налогоплательщиков»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 17.07.2008 № 36-ЗКО «О залоговом фонде Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 26.11.2003 № 57-ЗКО «О налоге на имущество организаций»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 11.12.2019 № 129-ЗКО «Об инвестиционном налоговом вычете по налогу на прибыль организаций на территории Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 14.12.2020 № 112-ЗКО «Об отдельных вопросах реализации региональных инвестиционных проектов в Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Закон Курской области от 14.12.2020 № 112-ЗКО «Об отдельных вопросах реализации региональных инвестиционных проектов в Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                    </div>
                    <h4>Законы Курской области</h4>
                    <div class="columns-box columns-box--two-col">
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 03.04.2017 № 282-па «Об утверждении Правил предоставления за счет бюджетных ассигнований Инвестиционного фонда Курской области субсидий бюджетам муниципальных образований Курской области на софинансирование капитальных вложений в объекты муниципальной собственности»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Губернатора Курской области от 21.06.2017 № 192-пг «О мерах по реализации закона Курской области от 22.06.2015 № 58-ЗКО «Об установлении критериев, которым должны соответствовать объекты социально-культурного и коммунально-бытового назначения, масштабные инвестиционные проекты, для размещения (реализации) которых допускается предоставление земельных участков в аренду без проведения торгов»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 11.02.2016 № 62-па «Об уполномоченном органе исполнительной власти Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 21.05.2014 № 324-па «Об утверждении Регламента комплексного сопровождения инвестиционных проектов (инвесторов) по принципу «одного окна»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 27.05.2014 N 338-па «Об утверждении Положения об условиях и порядке создания индустриальных (промышленных) парков»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Губернатора Курской области от 02.12.2014 № 527-пг «Об утверждении Инвестиционной стратегии Курской области до 2025 года»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 08.12.2014 № 799-па «Об утверждении Порядка формирования и использования бюджетных ассигнований Инвестиционного фонда Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Постановление Администрации Курской области от 29.03.2013 № 175-па «О порядке проведения оценки регулирующего воздействия проектов нормативных правовых актов»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                    </div>
                    <h4>Примерная форма бизнес-плана инвестиционного проекта</h4>
                    <div class="columns-box columns-box--two-col">
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Распоряжение Правительства Курской области от 8 февраля 2008 г. N 53-р
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                    </div>
                    <h4>Приказы</h4>
                    <div class="columns-box columns-box--two-col">
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Приказ комитета по экономике и развитию Курской области от 21.04.2015 № 8-а «Об утверждении методики расчета показателей абсолютной и относительной финансовой устойчивости, которым должны соответствовать коммерческие организации, претендующие на предоставление ...
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Приказ комитета по экономике и развитию Курской области от 20.10.2015 № 75-о «Об утверждении форм документов, предоставляемых инвесторами на вхождение в режим наибольшего благоприятствования или реализующих инвестиционные проекты в режиме ...
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Приказ комитета по экономике и развитию Курской области от 25.12.2012 № 55-а «Об утверждении Положения о порядке ведения реестра инвестиционных проектов Курской области»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                        <div class="doc-link">
                            <span class="doc-link__caption">
                                Приказ комитета по экономике и развитию Курской области от 27.07.2012 № 18-а/1 «Об утверждении примерной формы бизнес-плана инвестиционного проекта и рекомендаций по его разработке»
                            </span>
                            <a href="#" class="doc-link__download">Скачать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
