<header id="header">
    <div class="inner">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('img/logo.svg')}}" alt="">
            {{-- <a href="{{ route('events') }}" class="header-icon-btn header-icon-btn--bell header__notifications header__notifications--active">Уведомления</a> --}}
            <div class="user-menu-box header__notifications">
                <button class="header-icon-btn header-icon-btn--user"></button>
                <ul class="user-menu">
                    <li>
                        <span class="chel-icon"></span>
                        <a href="#">Личный кабинет</a>
                    </li>
                    <li>
                        <span class="exit-icon"></span>
                        <a href="{{route('logout')}}">Выход</a>
                    </li>
                </ul>
            </div>
            <button class="header-icon-btn burger-btn"><span></span></button>
        </a>
    </div>
    <nav>
        <menu class="main-menu ">
            <li>
                <div class="main-menu__parent-panel">
                    <span>Мои инвестиционные проект</span>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon active" >
                        <a href="{{route('projects')}}">Все проекты</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="{{route('project_create')}}">Подать проект</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="main-menu__parent-panel">
                    <a href="{{route('applicationСatalog')}}">Мои заявления на государственную поддержку</a>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
                        <a href="{{ route('support') }}">Все заявления</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="{{ route('support_select') }}">Подать заявление</a>
                    </li>
                    <li class="handshake-icon">
                        <a target="_blank" href="https://navigator-mp.kursk.ru/">Меры поддержки</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="main-menu__parent-panel">
                    <span>Заявления на технологическое присоединение</span>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
                        <a href="{{ route('technical_connect') }}">Все заявления</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="{{ route('technical_connect_create') }}">Подать заявку на технологическое присоединение</a>
                    </li>
                    <li class="list-icon">
                        <a href="{{ route('technical_connect_algoritm') }}">Алгоритмы действий инвестора по технологическому присоединению</a>
                    </li>
                    <li class="bagdoc-icon">
                        <a href="{{ route('technical_connect_org_list') }}">Список ресурсоснабжающих организаций</a>
                    </li>
                </ul>
            </li>
        </menu>
    </nav>
</header>
