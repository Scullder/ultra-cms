@extends('layouts.app')

@section('body')
    <div class="w-10/12 mx-auto my-8">
        <button type="submit" form="form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </div>
    <div class="w-10/12 mx-auto p-6 bg-white rounded shadow-md my-8">
        <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}" id="form">
            @csrf
            @method('PUT')            
            <x-h1>Создание новой категории</x-h1>
            <x-input label="Название категории" value="{{ old('name', $category->name) }}" name="name"/>
            <x-input label="Slug(Seo-url)" value="{{ old('slug', $category->slug) }}" name="slug"/>
        </form>
    </div>
@endsection