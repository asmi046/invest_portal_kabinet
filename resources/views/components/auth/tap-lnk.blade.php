<ul class="authreg__nav-link-list">
    <li>
        <a @class(['active' => Route::currentRouteName() === 'login']) href="{{route('login')}}">Вход</a>
    </li>
    <li>
        <a @class(['active' => Route::currentRouteName() === 'register']) href="{{route('register')}}">Регистрация</a>
    </li>
</ul>
