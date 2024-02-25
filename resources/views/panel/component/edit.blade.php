@extends('layouts.app')

@section('body')
    <x-container>
        <button type="submit" form="constructor-form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </x-container>
    <x-container class="p-6 bg-white rounded shadow-md">
        <form method="post" action="{{ route('components.update', ['component' => $cmpnt]) }}" id="constructor-form">
            @csrf
            @method('PUT')

            <x-h1>Редактирование компонента</x-h1>
            <x-input label="Название компонента" value="{{ old('name', $cmpnt->name) }}" name="name"/>
            <x-input label="Уникальное обозначение (код)" value="{{ old('code', $cmpnt->code) }}" name="code"/>
            
            {{-- CATEGORIES_PAGES --}}
            <x-select.select source="{{ route('categories.select') }}" label="Дочерние страницы категорий" code="categories_pages">
                @foreach ($cmpnt->categories_pages as $category)
                    <x-select.selected selectOptionName="categories_pages" value="{{ $category->id }}" label="{{ $category->name }}"/>
                @endforeach
            </x-select.select>

           {{--  <pre>
                @php
                    //print_r(Session::all());
                    //print_r(old('categories_pages', 'empty'));
                @endphp
            </pre> --}}

            {{-- CATEGORIES --}}
            <x-select.select source="{{ route('categories.select') }}" label="Категории" code="categories">
                @foreach ($cmpnt->categories as $category)
                    <x-select.selected selectOptionName="categories" value="{{ $category->id }}" label="{{ $category->name }}"/>
                @endforeach
            </x-select.select>

            {{-- PAGES --}}
            <x-select.select source="{{ route('pages.select') }}" label="Страницы" code="pages">
                @foreach ($cmpnt->pages as $page)
                    <x-select.selected selectOptionName="pages" value="{{ $page->id }}" label="{{ $page->name }}"/>
                @endforeach
            </x-select.select>

            <x-checkbox label="Глобальная привязка" name="global" checked="{{ $cmpnt->global }}"/>
            
            <x-h2>Поля компонента</x-h2>
            <div id="component-types" class="flex flex-col gap-4">
                @if (old('fields'))
                    @foreach (old('fields') as $uid => $field)
                        @include("panel/component/type/constructor/{$field['type']}", [
                            'field' => $field,
                            'uid' => $uid,
                        ])
                    @endforeach
                @else
                    @foreach ($cmpnt->fields as $field)
                        @include("panel/component/type/constructor/{$field['type']}", [
                            'field' => $field,
                            'uid' => $field['id'],
                        ])
                    @endforeach
                @endif
            </div>
            <x-button class="mt-4"
                hx-get="{{ route('types.index') }}" 
                hx-target="body" 
                hx-swap="beforeend">Добавить поле</x-button>
        </form>
    </x-container>
@endsection