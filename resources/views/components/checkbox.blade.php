@props([
    'checked' => false, 
    'value' => 1, 
    'label' => null,
    'name' => '',
])

<div class="mb-4 text-gray-600 select-none">
    <label class="cursor-pointer">
        <input type="checkbox" value="{{ $value }}" name="{{ $name }}" class="cursor-pointer mr-2" @checked($checked)>{{ $label }}
    </label>
</div>