@extends('layouts.all')

@php
    $title = "Редактирование инвестиционного проекта";
    $description = "Редактирование инвестиционного проекта. Отредактируйте проект и отправьте на модерацию.";
@endphp

@section('title', $title)
@section('description', $description)

@section('body')
    <div class="inner">
        <x-breadcrumbs
            :title="$title.' №'.$item->id"
            sub="{{ route('area_get') }}"
            subtitle="Мои заявления"
        ></x-breadcrumbs>
        <h1>{{ $title }} №{{$item->id}}</h1>

        <x-goskey.sign-document :document="$item"></x-goskey.sign-document>

        <x-organization-report :item="$item"></x-organization-report>

        <x-area-get.edit-form :item="$item" format="edit" :action="route('area_get_save')"></x-area-get.edit-form>


    </div>
@endsection
