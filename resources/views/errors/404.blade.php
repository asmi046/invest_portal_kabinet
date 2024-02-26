@extends('layouts.auth')

@php
    $title = "Ошибка 404";
    $description = "Ошибка 404 - страница не найдена";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>404</h1>
@endsection

