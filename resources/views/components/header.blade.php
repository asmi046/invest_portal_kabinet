<header id="header">
    <div class="inner">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('img/logo.svg')}}" alt="">
            <a href="{{ route('events') }}" class="header-icon-btn header-icon-btn--bell header__notifications header__notifications--active">Уведомления</a>
            <div class="user-menu">
                <button class="header-icon-btn header-icon-btn--user"></button>
            </div>
            <button class="header-icon-btn burger-btn"><span></span></button>
        </a>
    </div>
    <nav>
        <menu class="main-menu ">
            <li>
                <div class="main-menu__parent-panel">
                    <a href="#">Мои инвестиционные проект</a>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
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
                        <a href="{{ route('support') }}" class="active">Все заявления</a>
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
                    <a href="#">Заявления на технологическое присоединение</a>
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
