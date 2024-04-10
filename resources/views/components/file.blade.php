@props([
    'value' => '', 
    'slot' => null,
    'label' => false,
    'name' => '',
    'id' => '',
])

<div {{ $attributes->merge(['class' => 'mb-4 flex items-start flex-col']) }}>
    @if ($label)
        <label class="text-gray-600 @error(dot_name($name)) text-red-500 @enderror">{{ $label }}</label>
    @endif
    
    <input class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-sky-500 w-full @error(dot_name($name)) border-red-500 @enderror"
        type="file" 
        {{-- value="{{ $value }}" --}} 
        name="{{ $name }}" 
        id="{{ $id }}" 
        {{ $attributes->whereStartsWith('hx') }}
        {{ $attributes }}
    >
    
    @error(dot_name($name))
        <label class="text-red-500">{{ $message }}</label>
    @enderror
</div>
