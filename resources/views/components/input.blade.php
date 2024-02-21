@if ($attributes['hidden'])
    <input type="text" value="{{ $value ?? '' }}" name="{{ $name ?? '' }}" hidden />
@else
    <div class="mb-4 flex items-start flex-col">
        @if ($label)
            <label class="text-gray-600 @error(dot_name($name)) text-red-500 @enderror">{{ $label }}</label>
        @endif
        
        <input type="text" value="{{ $value ?? '' }}" name="{{ $name ?? '' }}" 
            class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-blue-500 w-full @error(dot_name($name)) border-red-500 @enderror"> 
        
        @error(dot_name($name))
            <label class="text-red-500">{{ $message }}</label>
        @enderror
    </div>
@endif
