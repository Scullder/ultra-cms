<x-container class="p-6 bg-white rounded shadow-md">
    <x-h3>File</x-h3>
    <x-input value="file" label="" name="fields[{{ $uid }}][type]" hidden/>
    
    <x-input label="Название (уникальный код)" value="{{ $field['code'] ?? '' }}" name="fields[{{ $uid }}][code]"/>
    <x-input label="Подпись при заполнении" value="{{ $field['label'] ?? '' }}" name="fields[{{ $uid }}][label]"/>

    <x-checkbox label="Обязательное поле" name="fields[{{ $uid }}][required]" checked="{{ $field['required'] ?? false }}"/> 
    <x-checkbox label="Коллекция" name="fields[{{ $uid }}][multiple]" checked="{{ $field['multiple'] ?? false }}"/>
</x-container>