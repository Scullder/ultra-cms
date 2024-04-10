@extends('layouts.app')

@section('body')
    <x-container class="mt-4">
        <button type="submit" form="constructor-form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОЗДАТЬ
        </button>
    </x-container>
    <form method="post" action="{{ route('components.store') }}" id="constructor-form">
        <x-container class="p-6 bg-white rounded shadow-md">
            @csrf
            <x-h1>Создание нового компонента</x-h1>
            <x-input label="Название компонента" value="{{ old('name') }}" name="name"/>
            <x-input label="Уникальное обозначение (код)" value="{{ old('code') }}" name="code"/>
            
            {{-- CATEGORIES_PAGES --}}
            <x-select.select source="{{ route('categories.select') }}" label="Дочерние страницы категорий" code="categories_pages">
                @foreach (old('categories_pages') ?? [] as $category)
                    <x-select.selected selectOptionName="categories_pages" value="{{ $category }}" label="{{ old('categories_pages_labels')[$loop->index] }}" />
                @endforeach
            </x-select.select>

            {{-- CATEGORIES --}}
            <x-select.select source="{{ route('categories.select') }}" label="Категории" code="categories">
                @foreach (old('categories') ?? [] as $category)
                    <x-select.selected selectOptionName="categories" value="{{ $category }}" label="{{ old('categories_labels')[$loop->index] }}" />
                @endforeach
            </x-select.select>

            {{-- PAGES --}}
            <x-select.select source="{{ route('pages.select') }}" label="Страницы" code="pages">
                @foreach (old('pages') ?? [] as $page)
                    <x-select.selected selectOptionName="pages" value="{{ $page }}" label="{{ old('pages_labels')[$loop->index] }}" />
                @endforeach
            </x-select.select>

            <x-checkbox label="Глобальная привязка" name="global"/>
            <x-checkbox label="Коллекция" name="multiple"/>
        </x-container>
            
        <x-container>
            <x-h2>Поля компонента</x-h2>
        </x-container>

        <div id="component-types" class="flex flex-col gap-4">
            @foreach (old('fields') ?? [] as $uid => $field)
                @include("panel/component/type/constructor/{$field['type']}", [
                    'field' => $field,
                    'uid' => $uid,
                ])
            @endforeach
        </div>
        
        <x-container>
            <x-button class="mt-4" hx-get="{{ route('types.index') }}" hx-target="body" hx-swap="beforeend">Добавить поле</x-button>
        </x-container>
    </form>
@endsection