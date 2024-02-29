@extends('layouts.auth')

@php
    $title = "Ошибка авторизации через ЕСИА";
    $description = "Ошибка авторизации через ЕСИА";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <h1>Ошибка авторизации</h1>
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

@endsection

