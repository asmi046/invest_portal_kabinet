@extends('layouts.all')

@php
    $title = "Редактирование инвестиционного проекта";
    $description = "Редактирование инвестиционного проекта. Отредактируйте проект и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <div class="inner">
        <ul class="breadcrumbs">
            <li>
                <a href="#">Главная</a>
                <i>/</i>
            </li>
            <li>
                <span>Подать заявление на государственную поддержку</span>
            </li>
        </ul>
        <h1>{{ $title }}</h1>
        <div class="columns-box columns-box--two-col">

        </div>
        <form class="form-project-submission flex-form">
            <div class="columns-box columns-box--two-col">
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Название проекта
                    </span>
                    <input type="text" name="name1" class="form-elem__field" required="required" placeholder="Введите название проекта">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Цель проекта
                    </span>
                    <input type="text" name="name2" class="form-elem__field" required="required">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Срок реализации
                    </span>
                    <input type="text" name="name3" class="form-elem__field" required="required">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Количество создаваемых рабочих мест
                    </span>
                    <input type="text" name="name4" class="form-elem__field" required="required">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Территория реализации проекта
                    </span>
                    <input type="text" name="name5" class="form-elem__field" required="required">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Территория реализации проекта
                    </span>
                    <input type="text" name="name6" class="form-elem__field" required="required">
                    @error('email')
                        <span class="form-elem__error-message">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <label class="form-elem">
                <span class="form-elem__caption">
                    Территория реализации проекта
                </span>
                <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="name7"></textarea>
                {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
            </label>
            <label class="form-elem">
                <span class="form-elem__caption">
                    Потребность в земельном участке и его краткая характеристика
                </span>
                <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="name8"></textarea>
                {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
            </label>
            <br>
            <br>
            <br>
            <div class="columns-box columns-box--two-col">
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Потребность в привлечении дополнительных средств для реализации инвестиционного проекта
                    </span>
                    <input type="text" name="name9" class="form-elem__field filtr-thousand" placeholder="Заемные средства, млн.руб.">
                    {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Потребность в привлечении дополнительных средств для реализации инвестиционного проекта
                    </span>
                    <input type="text" name="name10" class="form-elem__field filtr-thousand" placeholder="Бюджетные средства, млн.руб.">
                    {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Потребность в создании инженерной инфраструктуры (мощность, потребляемая по проекту в час)
                    </span>
                    <input type="text" name="name11" class="form-elem__field filtr-thousand" placeholder="Электроснабжение, МВт">
                    {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Потребность в создании инженерной инфраструктуры (мощность, потребляемая по проекту в час)
                    </span>
                    <input type="text" name="name12" class="form-elem__field filtr-thousand" placeholder="Газоснабжение, м3">
                    {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
                </label>
                <label class="form-elem">
                    <span class="form-elem__caption">
                        Потребность в создании инженерной инфраструктуры (мощность, потребляемая по проекту в час)
                    </span>
                    <input type="text" name="name13" class="form-elem__field filtr-thousand" placeholder="Водоснабжение, м3">
                    {{-- <span class="form-elem__error-message">текст ошибки</span> --}}
                </label>
            </div>
            <div class="form-elem">
                <span class="form-elem__caption">
                    Пункт выбора нескольких вариантов
                </span>
                <div class="form-elem-racheck-box">
                    <label class="form-checkbox">
                        <input type="checkbox" name="check1">
                        <i></i>
                        <span>да</span>
                    </label>
                    <label class="form-checkbox">
                        <input type="checkbox" name="check2">
                        <i></i>
                        <span>Нет</span>
                    </label>
                </div>
            </div>
            <div class="form-elem">
                <span class="form-elem__caption">
                    Пункт выбора одного вариантов
                </span>
                <div class="form-elem-racheck-box">
                    <label class="form-radio">
                        <input type="radio" name="radio1">
                        <i></i>
                        <span>Да</span>
                    </label>
                    <label class="form-radio">
                        <input type="radio" name="radio1">
                        <i></i>
                        <span>Нет</span>
                    </label>
                </div>
            </div>
            <div class="file-funnel">
                <input type="file" name="file" class="file-funnel__file-input" multiple="multiple">
                <div class="file-funnel__text">
                    <span class="file-funnel__caption">
                        Загрузить файлы
                    </span>
                    <span class="file-funnel__direction">
                        В форматах doc, docx, pdf, jpg, png
                    </span>
                </div>
                <div class="file-funnel__receiver">
                    +
                </div>
                <div class="file-funnel__docs">
                    <button type="button" class="file-funnel-btn file-funnel-btn--reset">Очистить</button>
                </div>
            </div>
            {{-- для получения данных подгруженных файлов используется метот getUploadedFiles() класса FileFunnel.
                См. в файле v-script.js --}}
                <div class="form-control-panel">
                    <button type="button" class="btn" title="Сохранить"> <span class="save-icon"></span> Сохранить</button>
                    <button type="button" class="btn" title="Печатная версия"> <span class="print-form-icon"></span> </button>
                    <button type="button" class="btn" title="Подписать"> <span class="sign2-icon"></span> Подписать</button>
                </div>
        </form>


    </div>
@endsection
