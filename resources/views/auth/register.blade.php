
@extends('layouts.auth')

@php
    $title = "Регистрация - Инвестиционный портал Курской области";
    $description = "Регистрация в инвестиционном портале Курской области";
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

                <x-auth.tap-lnk></x-auth.tap-lnk>

                <form  action="{{route('register_do')}}" method="post" class="registration-form">
                    @csrf
                    <div class="columns-box columns-box--two-col">
                        <label class="form-elem">
                            <span class="form-elem__caption">Адрес электронной почты</span>
                            <input type="email" name="email" class="form-elem__field" required="required" placeholder="Введите email">

                            @error('email')
                                <span class="form-elem__error-message">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="form-elem">
                            <span class="form-elem__caption">Телефон</span>

                            <input type="text" name="phone" class="form-elem__field tel-mask" required="required" placeholder="Введите номер телефона">
                            @error('phone')
                                <span class="form-elem__error-message">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="form-elem">
                            <span class="form-elem__caption">Имя</span>

                            <input type="text" name="name" class="form-elem__field" required="required" placeholder="Введите ФИО">

                            @error('name')
                                <span class="form-elem__error-message">{{ $message }}</span>
                            @enderror
                        </label>

                        <div class="form-elem">
                            <span class="form-elem__caption">Пароль</span>

                            <div class="form-elem__password-field-box">
                                <input type="password" name="password" class="form-elem__field" required="required" placeholder="Введите пароль">
                                <button type="button"  class="form-elem__btn-show-pass"></button>
                            </div>

                            @error('password')
                                <span class="form-elem__error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-elem">
                            <span class="form-elem__caption">Подтвердить пароль</span>

                            <div class="form-elem__password-field-box">
                                <input type="password" name="password_confirmation" class="form-elem__field" required="required" placeholder="Повторите пароль">
                                <button type="button"  class="form-elem__btn-show-pass"></button>
                            </div>

                            @error('password_confirmation')
                                <span class="form-elem__error-message">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <span class="form-infotext">
                        Нажимая кнопку "Зарегистрироваться" я выражаю согласие на обработку персональных данных в соответствии с политикой конфиденциальности портала
                    </span>
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>

                <x-auth.bottom-lnk :lnk="$esia_lnk"></x-auth.tap-lnk>

                <a href="{{route('login')}}" class="link-to-reg">
                    Уже есть аккаунт?
                </a>
            </div>
        </div>

    </div>
@endsection

