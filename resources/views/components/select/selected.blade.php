<div class="bg-white px-2 py-1 rounded border">
    <span class="font-semibol text-gray-500 cursor-pointer hover:text-black mr-1" onclick="this.parentElement.remove()">X</span>
    {{ $label }}
    <input type="hidden" value="{{ $value }}" name="{{ $name }}[]">
</div>