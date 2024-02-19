@extends('layouts.all')

@php
    $title = "Тест ЕСИА";
    $description = "Тест ЕСИА";
@endphp

@section('title', $title)
@section('description', $description)
<x-header></x-header>
@section('body')
    <h1>{{ $title }}</h1>
    <a href="{{$lnk}}">Пробуем войти</a>
@endsection
