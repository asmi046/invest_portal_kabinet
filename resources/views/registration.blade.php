
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
            <div class="authreg registation-elem">

                <h1 class="authreg__title alCenter">
                    Регистрация
                </h1>
                <ul class="authreg__nav-link-list">
                    <li>
                        <a href="{{route('auth')}}" >Вход</a>
                    </li>
                    <li>
                        <span class="active">Регистрация</span>
                    </li>
                </ul>
                <form class="registration-form">
                    <div class="columns-box columns-box--two-col">
                        <label class="form-elem">
                            <span class="form-elem__caption">
                                Адрес электронной почты
                            </span>
                            <input type="email" name="login" class="form-elem__field" required="required" placeholder="Введите email">
                            <span class="form-elem__error-message">Текст ошибки</span>
                        </label>
                        <label class="form-elem">
                            <span class="form-elem__caption">
                                Имя
                            </span>
                            <input type="text" name="name" class="form-elem__field" required="required" placeholder="Введите ФИО">
                            <span class="form-elem__error-message">Текст ошибки</span>
                        </label>
                        <div class="form-elem">
                            <span class="form-elem__caption">
                                Пароль
                            </span>
                            <div class="form-elem__password-field-box">
                                <input type="password" name="password" class="form-elem__field" required="required" placeholder="Введите пароль">
                                <button type="button"  class="form-elem__btn-show-pass"></button>
                            </div>
                            <span class="form-elem__error-message"></span>
                        </div>
                        <div class="form-elem">
                            <span class="form-elem__caption">
                                Подтвердить пароль
                            </span>
                            <div class="form-elem__password-field-box">
                                <input type="password" name="password-repeat" class="form-elem__field" required="required" placeholder="Повторите пароль">
                                <button type="button"  class="form-elem__btn-show-pass"></button>
                            </div>
                            <span class="form-elem__error-message"></span>
                        </div>
                        <label class="form-elem">
                            <span class="form-elem__caption">
                                Телефон
                            </span>
                            <input type="text" name="name" class="form-elem__field tel-mask" required="required" placeholder="Введите номер телефона">
                            <span class="form-elem__error-message">Текст ошибки</span>
                        </label>
                    </div>
                    <span class="form-infotext">
                        Нажимая кнопку "Зарегистрироваться" я выражаю согласие на обработку персональных данных в соответствии с политикой конфиденциальности портала
                    </span>
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>
                <div class="esia-enter">
                    Регистрация через
                    <a href="#" class="btn-esia">ЕСИА</a>
                </div>
                <a href="{{route('passwordRecovery')}}" class="link-to-reg">
                    Забыли пароль?
                </a>
            </div>
        </div>

    </div>
@endsection

