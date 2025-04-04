@extends('layouts.all')

@php
    $title = "Данные пользователя";
    $description = "Данные пользователя";
@endphp

@section('title', $title)
@section('description', $description)
@section('body')

<section class="my-project-section">
    <div class="inner">
        <x-breadcrumbs title="Изменение личных данных польхователя"></x-breadcrumbs>

        <h2>Мои данные</h2>
        <form class="flex-form" action="{{ route('save_user_data') }}" method="POST">
            @csrf

            @if (session('success_user_data'))
                <div class="form-status form-status--success">
                    {{ session('success_user_data') }}
                </div>
            @endif

            <label class="form-elem">
                <span class="form-elem__caption">
                    Фамилия<span class="required">*</span>
                </span>
                <input type="text" name="lastname" class="form-elem__field"  value="{{ $user->lastname ?? '' }}">
                @error('lastname')
                    <span class="form-elem__error-message">{{ $message }}</span>
                @enderror
            </label>

            <label class="form-elem">
                <span class="form-elem__caption">
                    Имя<span class="required">*</span>
                </span>
                <input type="text" name="name" class="form-elem__field"  value="{{ $user->name ?? '' }}">
                @error('name')
                    <span class="form-elem__error-message">{{ $message }}</span>
                @enderror
            </label>

            <label class="form-elem">
                <span class="form-elem__caption">
                    Отчество<span class="required">*</span>
                </span>
                <input type="text" name="fathername" class="form-elem__field"  value="{{ $user->fathername ?? '' }}">
                @error('fathername')
                    <span class="form-elem__error-message">{{ $message }}</span>
                @enderror
            </label>

            <label class="form-elem">
                <span class="form-elem__caption">
                    E-mail<span class="required">*</span>
                </span>
                <input type="email" name="email" class="form-elem__field" readonly value="{{ $user->email ?? '' }}">
                @error('email')
                    <span class="form-elem__error-message">{{ $message }}</span>
                @enderror
            </label>

            <label class="form-elem">
                <span class="form-elem__caption">
                    Телефон<span class="required">*</span>
                </span>
                <input type="tel" name="phone" class="form-elem__field tel-mask"  value="{{ $user->phone ?? '' }}">
                @error('phone')
                    <span class="form-elem__error-message">{{ $message }}</span>
                @enderror
            </label>

            <button type="submit" class="btn" title="Сохранить данные" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить данные</button>
        </form>

        <h2>Смена пароля</h2>

        <form class="flex-form" action="{{ route('chenge_user_password') }}" method="POST">
            @csrf

            @if (session('success_user_pass'))
                <p class="success">{{ session('success_user_pass') }}</p>
            @endif
            <div class="columns-box columns-box--two-col">
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Введите новый пароль<span class="required">*</span>
                    </span>
                    <input type="password" name="password" class="form-elem__field" >
                    @error('password')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form-elem">
                    <span class="form-elem__caption">
                        Подтвердите пароль<span class="required">*</span>
                    </span>
                    <input type="password" name="password_confirmation" class="form-elem__field" >
                    @error('password_confirmation')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
            </div>

            <button type="submit" class="btn" title="Сменить пароль" name="action" value="create_draft"> <span class="save-icon"></span>Сменить пароль</button>

        </form>
    </div>
</section>

@endsection
