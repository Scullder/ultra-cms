{{-- {{ $field->code }} --}}
@php
    $name = "components[{$cmpnt->code}][{$field->code}]";
@endphp
<x-input label="{{ $field->label }}" value="{{ old(dot_name($name), $field->value) }}" name="{{ $name }}"/>
