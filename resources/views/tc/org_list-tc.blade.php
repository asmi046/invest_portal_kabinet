@extends('layouts.all')

@php
    $title = "Список ресурсоснабжающих организаций";
    $description = "Список ресурсоснабжающих организаций";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>{{ $title }}</h1>


@endsection
