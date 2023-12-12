@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')
    <h1>Test</h1>
@endsection
