@props([
    'value' => '', 
    'slot' => null,
    'label' => false,
    'name' => '',
    'id' => '',
    'preview' => false,
])

<div {{ $attributes->merge(['class' => 'mb-4 flex items-start flex-col']) }}>
    @if ($label)
        <label class="text-gray-600 @error(dot_name($name)) text-red-500 @enderror">{{ $label }}</label>
    @endif
    
    <input class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-sky-500 w-full @error(dot_name($name)) border-red-500 @enderror"
        type="file" 
        value="{{ $value }}" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        {{ $attributes->whereStartsWith('hx') }}
        {{-- {{ $attributes }} --}}
    >

    @if ($preview)
        @if (!is_array($preview))
            {{-- <img src="{{ $preview }}" class="w-[200px] h-[200px]"/> --}}
            <div class="relative rounded mt-2">
                <img src="{{ $preview }}" class="object-contain max-h-[220px] rounded" />
                {{-- <div className="absolute top-0 left-0 w-full h-full hover:bg-rose-400/10 hover:cursor-default"></div> --}}
            </div>
        @endif
    @endif
    
    @error(dot_name($name))
        <label class="text-red-500">{{ $message }}</label>
    @enderror
</div>
<script>
    clearPreview = (id) => {
        $document.querySelector(`#${id}`)
    }
</script>
