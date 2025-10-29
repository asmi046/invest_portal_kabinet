
@extends('layouts.auth')

@php
    $title = "Вход - Инвестиционный портал Курской области";
    $description = "Вход в инвестиционный портал Курской области";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <div class="full-space">
        <div class="authreg-box">
            <div class="modal-portal-logo">
                <img src="{{asset('img/kursk-gerb.svg')}}" class="modal-portal-logo__img" alt="">
                <span class="modal-portal-logo__caption">Инвестиционный портал  <br> Курской области</span>
            </div>
            <div class="authreg auth-elem">
                <h1 class="authreg__title alCenter">
                    Авторизация
                </h1>

                <x-auth.tap-lnk></x-auth.tap-lnk>

                <form action="{{route('login_do')}}" method="post" class="auth-form">
                    @csrf
                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Адрес электронной почты
                        </span>
                        <input type="email" name="email" class="form-elem__field" required="required" placeholder="Введите email">
                        @error('email')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="form-elem">
                        <span class="form-elem__caption">
                            Пароль
                        </span>
                        <div class="form-elem__password-field-box">
                            <input type="password" name="password" class="form-elem__field" required="required" placeholder="Введите пароль">
                            <button type="button"  class="form-elem__btn-show-pass"></button>
                        </div>

                        @error('password')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="form-checkbox">
                        <input type="checkbox" name="remember-me">
                        <i></i>
                        <span>запомнить меня</span>
                    </label>
                    <span class="form-infotext">
                        Нажимая кнопку "Войти" я выражаю согласие на обработку персональных данных в соответствии с политикой конфиденциальности портала
                    </span>
                    <button type="submit" class="btn">Войти</button>
                </form>
                <x-auth.bottom-lnk :lnk="$esia_lnk"></x-auth.tap-lnk>

                <a href="{{route('passrec')}}" class="link-to-reg">
                    Забыли пароль?
                </a>
            </div>
        </div>
    </div>
@endsection

