@php
    $name = "components[{$cmpnt['code']}][fields][{$field['code']}][value]";
@endphp

<x-input label="{{ $field['label'] }}" value="{{ old(dot_name($name), $field['value']) }}" name="{{ $name }}"/>
