@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
     <section class="statement-section">
        <div class="inner">
            <x-breadcrumbs
                sub="{{route('support')}}"
                subtitle="Мои заявления на государственную поддержку"
                title="Статус заявления"
            ></x-breadcrumbs>

            <h1>Заявление на: {{ $support->name }}</h1>
            <p>
                Статус: <strong>{{ $support->state }}</strong>
            </p>
            <div class="stages-box">
                <h2 class="section-title">Этап рассмотрения:</h2>
                <ul class="stages">
                    @php
                        $passed = true;
                    @endphp
                    @foreach ($statuses as $item)
                        @php
                            if ($item === $support->state)
                                $passed = false;
                        @endphp
                        <li @class(
                        ['stages-item',
                         'stages-item--passed' => $passed,
                         'stages-item--current' => $item === $support->state
                         ])>
                            <div class="stages-item__marker"></div>
                            <div class="stages-item__text">{{ $item }}</div>
                        </li>

                    @endforeach
                </ul>
            </div>
            <h2 class="section-title">Срок рассмотрения:</h2>
            <p>
                Срок рассмотрения {{$time}} рабочих дней(я)
            </p>
        </div>
     </section>
@endsection
