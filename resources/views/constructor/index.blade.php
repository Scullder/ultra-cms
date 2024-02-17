@extends('layouts.app')

@section('body')
    <div class="container w-9/12 mx-auto mt-32 p-6 bg-white rounded shadow-md">
        <x-h1>Создание нового компонента</x-h1>
        <x-input label="Название компонента" value="" name=""/>
    
        <x-h2>Поля компонента</x-h2>
        <div id="component-types" class="flex flex-col"></div>
    
        <x-button hx-get="{{ route('constructor.types') }}" hx-target="body" hx-swap="beforeend">Добавить поле</x-button>
    </div>
@endsection