@extends('layouts.all')

@php
    $title = "Статус заявления на технологическое присоединение";
    $description = "Статус заявления на технологическое присоединение";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
     <section class="statement-section">
        <div class="inner">
            <x-breadcrumbs
                sub="{{route('technical_connect')}}"
                subtitle="Мои заявления"
                title="Статус заявления"
            ></x-breadcrumbs>

            <h1>Этапы работы над заявлением №: {{ $tc->id }}</h1>
            <p>
                Статус: <strong>{{ $tc->state }}</strong>
            </p>
            <div class="stages-box">
                <h2 class="section-title">Этап рассмотрения:</h2>
                <ul class="stages">
                    @php
                        $passed = true;
                        $sendet = "";

                        if ( $tc->state === "Подписан и отправлен" )
                            $statuses = array_diff($statuses, ["Отправлен"]);


                        if ( $tc->state === "Отправлен" )
                            $statuses = array_diff($statuses, ["Подписан и отправлен"]);

                    @endphp

                    @foreach ($statuses as $item)
                        @php
                            if ($item === $tc->state)
                                $passed = false;

                            // if (in_array($project->state, config('documents.statuses_noedit')) )
                        @endphp

                        <li @class(
                        ['stages-item',
                         'stages-item--passed' => $passed,
                         'stages-item--current' => $item === $tc->state
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
