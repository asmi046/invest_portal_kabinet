<header id="header">
    <div class="inner">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('img/logo.svg')}}" alt="">
            <a href="#" class="header-icon-btn header-icon-btn--bell header__notifications header__notifications--active">Уведомления</a>
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
                    <a href="#">Заявить инвестиционный проект</a>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
                        <a href="{{route('myProject')}}">Мои проекты</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="#">Подать проект</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="main-menu__parent-panel">
                    <a href="{{route('applicationСatalog')}}">Подать заявление на государственную поддержку</a>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
                        <a href="#" class="active">Мои заявления</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="#">Подать заявление</a>
                    </li>
                    <li class="handshake-icon">
                        <a href="#">Меры поддержки</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="main-menu__parent-panel">
                    <a href="#">Заявление на технологическое присоединение</a>
                    <button class="main-menu__arrow"></button>
                </div>
                <ul>
                    <li class="doc-icon">
                        <a href="#">Мои заявления</a>
                    </li>
                    <li class="pencil-icon">
                        <a href="#">Подать заявку на технологическое присоединение</a>
                    </li>
                    <li class="list-icon">
                        <a href="#">Алгоритмы действий инвестора по технологическому присоединению</a>
                    </li>
                    <li class="bagdoc-icon">
                        <a href="#">Список ресурсоснабжающих организаций</a>
                    </li>
                </ul>
            </li>
        </menu>
    </nav>
</header>
