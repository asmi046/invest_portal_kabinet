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
                        <a href="{{route('user-data')}}">Мои данные</a>
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

    <x-side-menu.main-menu></x-side-menu.main-menu>

</header>
