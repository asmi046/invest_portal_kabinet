@extends('layouts.all')

@php
    $title = "Заголовок";
    $description = "Дескрипшен";
@endphp

@section('title', $title)
@section('description', $description)
<x-header></x-header>
@section('body')
    <h1>Test</h1>
@endsection
