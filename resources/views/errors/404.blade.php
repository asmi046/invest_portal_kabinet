@extends('layouts.auth')

@php
    $title = "Ошибка 404";
    $description = "Ошибка 404 - страница не найдена";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
<div class="full-space">
    <div class="authreg-box">
        <h1 class="title-404 alCenter">404</h1>
        <p class="alCenter">Страница не найдена</p>
        <a href="{{route('home')}}" class="btn m0a">На главную</a>
    </div>

</div>

@endsection

