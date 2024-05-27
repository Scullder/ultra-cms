@php
    $name = "components[{$cmpnt['code']}][fields][{$field['code']}][value]";
    $id = "{$cmpnt['code']}-{$field['code']}";
@endphp

{{-- <x-file type="file" label="{{ $field->label }}" value="{{ $field->value }}" name="{{ $name }}" multiple/> --}}
{{-- <label class="text-gray-600 @error(dot_name($name)) text-red-500 @enderror">{{ $field['label'] }}</label>
<input class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-sky-500 w-full mb-4"
    type="file" 
    name="{{ $name }}"
> --}}

<x-file label="{{ $field['label'] }}" name="{{ $name }}" id="{{ $id }}" value="{{ $field['value'] }}" preview="{{ asset('storage/' . $field['value']) }}"/>
