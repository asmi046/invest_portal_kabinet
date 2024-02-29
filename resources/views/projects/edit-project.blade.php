@extends('layouts.all')

@php
    $title = "Редактирование инвестиционного проекта";
    $description = "Редактирование инвестиционного проекта. Отредактируйте проект и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>{{ $title }}</h1>


@endsection
