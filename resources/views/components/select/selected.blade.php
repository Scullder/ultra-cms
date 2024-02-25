<div class="bg-white px-2 py-1 rounded border border-gray-400 mb-2">
    <span class="font-semibol text-gray-500 cursor-pointer hover:text-black mr-1" onclick="this.parentElement.remove()">X</span>
    {{ $label }}
    <input type="hidden" value="{{ $value }}" name="{{ $selectOptionName }}[]">
    <input type="hidden" value="{{ $label }}" name="{{ $selectOptionName }}_labels[]">
</div>