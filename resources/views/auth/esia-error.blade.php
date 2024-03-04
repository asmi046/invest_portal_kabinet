@extends('layouts.auth')

@php
    $title = "Ошибка авторизации через ЕСИА";
    $description = "Ошибка авторизации через ЕСИА";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
<div class="full-space">
    <div class="authreg-box">
        <h1 class="alCenter">Ошибка авторизации</h1>
        <p>К сожалению при авторизации через сервис ЕСИА возникла ошибка</p>
        @error('esia_error')
            <pre>
                {{ $message }}
            </pre>
        @enderror
        @error('in')
            <pre>
                {{ $message }}
            </pre>
        @enderror
        <br>
        <a href="{{route('home')}}" class="btn m0a">На главную</a>
    </div>
</div>


@endsection

