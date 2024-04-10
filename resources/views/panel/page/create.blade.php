@extends('layouts.app')

@section('body')
    <x-container class="mt-4">
        <button type="submit" form="form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </x-container>
    <form method="post" action="{{ route('pages.store') }}" id="form">
        <x-container class="p-6 bg-white rounded shadow-md">
            @csrf
            <x-h1>Создание новой страницы</x-h1>
            <x-input label="Название страницы" value="{{ old('name') }}" name="name"/>
            <x-input label="Slug (seo-url)" value="{{ old('slug') }}" name="slug"/>
            <x-select.select source="{{ route('categories.select') }}" label="Категории" code="categories">
            </x-select.select>
        </x-container>
    </form>
@endsection