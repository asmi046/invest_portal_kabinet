@extends('layouts.all')

@php
    $title = "Редактирование заявления на государственную поддержку";
    $description = "Редактирование заявления на государственную поддержку. Создайте заявление и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>{{ $title }}</h1>


@endsection
