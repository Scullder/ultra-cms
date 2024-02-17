<div class="mb-2 flex items-start gap-1 flex-col">
    @if ($label)
        <label class="text-gray-600">{{ $label }}</label>
    @endif
    <input type="text" value="{{ $value ?? '' }}" name="{{ $name ?? '' }}"
        class="border border-gray-300 py-1 px-2 rounded-md outline-none focus:border-blue-500 w-full"> 
</div>