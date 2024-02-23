@extends('layouts.app')

@section('body')
    <div class="w-11/12 mx-auto my-8">
        <button type="submit" form="form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </div>
    <div class="w-11/12 mx-auto p-6 bg-white rounded shadow-md my-8">
        <form method="post" action="{{ route('pages.update', ['page' => $page->id]) }}" id="form">
            @csrf
            @method('PUT')            
            <x-h1>Редактирование страницы</x-h1>
            <x-input label="Название страницы" value="{{ old('name', $page->name) }}" name="name"/>
            <x-input label="Slug(Seo-url)" value="{{ old('slug', $page->slug) }}" name="slug"/>
            <x-select.select source="{{ route('categories.select') }}" label="Категории" code="categories">
                {{-- @foreach ($page->categories as $category) --}}
                
                @foreach ($categories as $category)
                    <x-select.selected name="categories" value="{{ $category->id }}" label="{{ $category->name }}" />
                @endforeach
            </x-select.select>
        </form>
    </div>
@endsection