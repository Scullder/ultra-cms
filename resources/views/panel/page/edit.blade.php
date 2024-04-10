@extends('layouts.app')

@section('body')
    <x-container class="mt-4">
        <button type="submit" form="form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </x-container>
    <form method="post" action="{{ route('pages.update', ['page' => $page->id]) }}" id="form" enctype="multipart/form-data">
        <x-container class="p-6 bg-white rounded shadow-md">
            @csrf
            @method('PUT')            
            <x-h1>Редактирование страницы</x-h1>
            <x-input label="Название страницы" value="{{ old('name', $page->name) }}" name="name"/>
            <x-input label="Slug(Seo-url)" value="{{ old('slug', $page->slug) }}" name="slug"/>
            <x-select.select source="{{ route('categories.select') }}" label="Категории" code="categories">
                @foreach ($page->categories as $category)
                    <x-select.selected selectOptionName="categories" value="{{ $category->id }}" label="{{ $category->name }}" />
                @endforeach
            </x-select.select>
        </x-container>

        @foreach ($page->components as $component)
            @include('panel/component/fill', ['cmpnt' => $component])
        @endforeach
    </form>
@endsection