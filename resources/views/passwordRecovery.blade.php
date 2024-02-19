
@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
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
            <div class="authreg password-recovery-elem">

                <h1 class="authreg__title alCenter">
                    Восстановление пароля
                </h1>
                <span class="form-infotext">
                    Для восстановления доступа укажите e-mail который использовался при регистрации аккаунта.
                </span>
                <form class="password-recovery-form">
                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Адрес электронной почты
                        </span>
                        <input type="email" name="email" class="form-elem__field" required="required" placeholder="Введите email">
                        <span class="form-elem__error-message">Текст ошибки</span>
                    </label>

                    <button type="submit" class="btn">Отправить</button>
                </form>
                <a href="{{route('auth')}}" class="link-to-reg">
                    Вспомнили пароль?
                </a>
            </div>
        </div>

    </div>
@endsection

