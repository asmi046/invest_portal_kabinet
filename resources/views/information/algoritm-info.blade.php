@extends('layouts.all')

@php
    $title = "Алгоритмы действий инвестора по технологическому присоединению";
    $description = "Алгоритмы действий инвестора по технологическому присоединению";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')


    <section class="my-project-section">
        <div class="inner">
            <x-breadcrumbs
                title="Алгоритмы действий инвестора"
            ></x-breadcrumbs>
            <h1>{{ $title }}</h1>

            <p>Свод инвестиционных правил – это алгоритмы действий («шаги») инвестора, планирующего реализацию инвестиционного проекта на территории Курской области.Разработаны в целях повышения прозрачности и упрощения взаимодействия инвестора с органами исполнительной власти, контрольными (надзорными) органами и ресурсными организациями при реализации инвестиционных проектов в части получения доступа к элементам инфраструктуры.</p>

            <p>Для упрощения использования алгоритмы действий инвестора представлены в виде схем в разделе «Доступ к инфраструктуре»</p>

            <br>
            <br>

            <div class="ip-tab">
                <div class="ip-tab-controller">
                    @php
                        $i= 0;
                    @endphp
                    @foreach ($algorithms as $key => $item)
                        <button @class(['ip-tab-controller__btn', 'active' => $i==0])>{{ $key }}</button>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </div>

                @php
                    $i= 0;
                @endphp
                @foreach ($algorithms as $key => $item)
                    <div @class(['ip-tab__display', 'active' => $i==0])>
                            @foreach ($item as $sub_key => $sub_item)
                                <h4>{{ $sub_key }}</h4>
                                <div class="columns-box columns-box--two-col">
                                    @foreach ($sub_item as $file_item)
                                        <x-widget-file
                                        :lnk="Storage::url('algoritmes/'.$file_item['file'])"
                                        :title="$file_item['title']"
                                        ></x-widget-file>
                                    @endforeach
                                </div>
                            @endforeach
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach

            </div>
        </div>
    </section>

@endsection
