@props([
    'value' => '', 
    'slot' => null,
    'selected' => false,
])
<div class="hover:bg-gray-100 p-1 cursor-pointer block w-full text-left bg-white"
    hx-get="{{ route('render.selected') }}" 
    hx-target="{{ $selectedSelector }}" 
    hx-trigger="click" 
    hx-params="*"
    hx-swap="beforeend"
    hx-include="this"
>
    {{ $label }}
    <input type="hidden" name="name"  value="{{ $name }}">
    <input type="hidden" name="value" value="{{ $value }}">
    <input type="hidden" name="label" value="{{ $label }}">
</div>