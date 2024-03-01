@extends('layouts.all')

@php
    $title = "Создание инвестиционного проекта";
    $description = "Создание инвестиционного проекта. Создайте проект и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>{{ $title }}</h1>


@endsection
