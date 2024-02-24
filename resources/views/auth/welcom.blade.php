@extends('layouts.all')

@php
    $title = "Вам отправлено письмо с подтверждением e-mail";
    $description = "Вам отправлено письмо с подтверждением e-mail";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <p>Поздравляем! Вы успешно зарегистрировались на Инвестиционном портале Курской области.</p>
    <p>На Ваш почтовый ящик: <a href="mailto:{{Auth::user()["email"]}}">{{Auth::user()["email"]}}</a> было отправленно сообщение для подтверждения аккаунта. Пожалуйста перейдите по ссылке в письме.</p>
    <p>После подтверждения Вам будет доступна возможность оставлять комментарии и ставить оценки проектам нормативных правовых актов.</p>

    <form action="{{ route ('verification.send') }}" method="POST">
        @csrf
        <h2>Повторная отправка подтверждения:</h2>
        <p>Повторная отправка подтверждения, у вас 6 попыток (не более 1 в минуту)</p>
        <button class="btn btn--turquoise" type="submit">Запросить пароль повторно</button>
    </form>

    <hr>

    <a class="btn btn--turquoise" href="{{route('home')}}">На главную</a>
@endsection

