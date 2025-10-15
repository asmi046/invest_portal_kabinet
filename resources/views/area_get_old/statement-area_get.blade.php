@extends('layouts.all')

@php
    $title = "Статус заявления на получение земельного участка";
    $description = "Статус заявления на получение земельного участка";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
     <section class="statement-section">
        <div class="inner">
            <x-breadcrumbs
                sub="{{route('area_get')}}"
                subtitle="Мои заявления на предоставление земельного участка"
                title="Статус проекта"
            ></x-breadcrumbs>

            <h1>Заявление на предоставлении земельного участка</h1>
            <p>
                Объект: <strong>{{ $project->object_name }}</strong>
            </p>
            <p>
                Тип объекта: <strong>{{ $project->object_type }}</strong>
            </p>
            <p>
                Заявитель: <strong>{{ $project->name }}, {{ $project->organization }}, {{ $project->dolgnost }}</strong>
            </p>
            <p>
                Статус: <strong>{{ $project->state }}</strong>
            </p>
            <div class="stages-box">
                <h2 class="section-title">Этап рассмотрения:</h2>
                <ul class="stages">
                    @php
                        $passed = true;
                        $sendet = "";

                        if ( $project->state === "Подписан и отправлен" )
                            $statuses = array_diff($statuses, ["Отправлен"]);


                        if ( $project->state === "Отправлен" )
                            $statuses = array_diff($statuses, ["Подписан и отправлен"]);

                    @endphp

                    @foreach ($statuses as $item)
                        @php
                            if ($item === $project->state)
                                $passed = false;

                            // if (in_array($project->state, config('documents.statuses_noedit')) )
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
