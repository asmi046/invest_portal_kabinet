@extends('layouts.auth')

@php
    $title = "Ошибка авторизации через ЕСИА";
    $description = "Ошибка авторизации через ЕСИА";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <section class="main-page-section">
        <div class="inner">

            <h1 class="alCenter">Ошибка авторизации</h1>
            <p>К сожалению при авторизации через сервис ЕСИА возникла ошибка</p>
            @error('esia_error')
                <p>
                    {{ $message }}
                </p>
            @enderror
            @error('error')
                <p>
                    {{ $message }}
                </p>
            @enderror

            @error('error_description')
                <p>
                    {{ $message }}
                </p>
            @enderror

            @error('state')
                <p>
                    {{ $message }}
                </p>
            @enderror
            <br>
            <a href="{{route('home')}}" class="btn m0a">На главную</a>
        </div>
    </section>


@endsection

