<ul class="breadcrumbs">
    <li>
        <a href="{{ route('home') }}">Главная</a>
        <i>/</i>
    </li>

    @isset($sub)
        <li>
            <a href="{{$sub}}">{{ $subtitle }}</a>
            <i>/</i>
        </li>
    @endisset

    @isset($title)
        <li>
            <span>{{ $title }}</span>
        </li>
    @endisset

</ul>
