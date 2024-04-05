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
                sub="{{route('projects')}}"
                subtitle="Мои инвестиционные проекты"
                title="Статус проекта"
            ></x-breadcrumbs>
            <h1>Проект: {{ $project->name }}</h1>
            <p>
                Статус: <strong>{{ $project->state }}</strong>
            </p>
            <div class="stages-box">
                <h2 class="section-title">Этап рассмотрения:</h2>
                <ul class="stages">
                    @php
                        $passed = true;
                    @endphp
                    @foreach ($statuses as $item)
                        @php
                            if ($item === $project->state)
                                $passed = false;
                        @endphp
                        <li @class(
                        ['stages-item',
                         'stages-item--passed' => $passed,
                         'stages-item--current' => $item === $project->state
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
