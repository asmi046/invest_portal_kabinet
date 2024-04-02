@extends('layouts.all')

@php
    $title = "Заявление на техническое присоединение";
    $description = "Заявление на техническое присоединение";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Подать заявление на техническое присоединение"
                sub="{{ route('technical_connect') }}"
                subtitle="Мои заявления"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <form class="form-project-submission flex-form" action="">
                @csrf
                <div class="columns-box columns-box--two-col">
                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Ф.И.О. заявителя
                        </span>
                        <input type="text" name="name" class="form-elem__field" required="required" placeholder="Заявитель">
                        @error('name')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Организация
                        </span>
                        <input type="text" name="company" class="form-elem__field" required="required">
                        @error('company')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <label class="form-elem">
                    <span class="form-elem__caption">
                        ЕГРЮЛ/ЕГРИП заявителя
                    </span>
                    <input type="text" name="egrip" class="form-elem__field" required="required">
                    @error('egrip')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form-elem">
                    <span class="form-elem__caption">
                        Адрес заявителя
                    </span>
                    <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="adress"></textarea>
                    @error('adress')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>

                <div class="columns-box columns-box--two-col">
                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Серия и номер
                        </span>
                        <input type="text" name="name" class="form-elem__field" required="required" placeholder="Заявитель">
                        @error('name')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-elem">
                        <span class="form-elem__caption">
                            Организация
                        </span>
                        <input type="text" name="company" class="form-elem__field" required="required">
                        @error('company')
                            <span class="form-elem__error-message">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

            </form>
        </div>
    </section>


@endsection
