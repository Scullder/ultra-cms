@extends('layouts.app')

@section('body')
    <div class="w-10/12 mx-auto my-8">
        <button type="submit" form="constructor-form" class="font-semibold text-sm ml-auto block py-4 px-6 bg-white rounded text-center shadow cursor-pointer hover:scale-95">
            СОХРАНИТЬ
        </button>
    </div>
    <div class="w-10/12 mx-auto p-6 bg-white rounded shadow-md my-8">
        <form method="post" action="{{ route('components.store') }}" id="constructor-form">
            @csrf
            <x-h1>Создание нового компонента</x-h1>
            <x-input label="Название компонента" value="{{ old('name') }}" name="name"/>
            <x-input label="Koд" value="{{ old('code') }}" name="code"/>
            <x-h2>Поля компонента</x-h2>
            <div id="component-types" class="flex flex-col gap-4">
                @foreach (old('fields') ?? [] as $uid => $field)
                    @include("panel/component/type/constructor/{$field['type']}", [
                        'field' => $field,
                        'uid' => $uid,
                    ])
                @endforeach
            </div>
            <x-button hx-get="{{ route('type') }}" hx-target="body" hx-swap="beforeend" class="mt-4">Добавить поле</x-button>
        </form>
    </div>
    {{-- @foreach ($errors->all() as $key => $error) 
        <div>{{ $key }} => {{ $error }}</div>
    @endforeach
    <pre>
        @php
            echo json_encode(session()->getOldInput());
        @endphp
    </pre> --}}
@endsection