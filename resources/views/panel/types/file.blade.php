{{-- {{ $field->code }} --}}
@php
    $name = "components[{$cmpnt->code}][{$field->code}]";
@endphp

{{-- <x-file type="file" label="{{ $field->label }}" value="{{ $field->value }}" name="{{ $name }}" multiple/> --}}

<input class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-sky-500 w-full"
    type="file" 
    {{-- value="{{ $value }}" --}} 
    name="{{ $name }}" 
>
