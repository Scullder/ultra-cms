<x-container class="p-6 bg-white rounded shadow-md">
    <x-h3>Text</x-h3>
    <x-input value="text" label="" name="fields[{{ $uid }}][type]" hidden/>
    
    <x-input label="Название (уникальный код)" value="{{ $field['code'] ?? '' }}" name="fields[{{ $uid }}][code]"/>
    <x-input label="Подпись при заполнении" value="{{ $field['label'] ?? '' }}" name="fields[{{ $uid }}][label]"/>
    <x-textarea label="Значение по умолчанию" value="{{ $field['default'] ?? '' }}" name="fields[{{ $uid }}][default]"/>

    <x-checkbox label="Обязательное поле" name="fields[{{ $uid }}][required]"/> 
    <x-checkbox label="Коллекция" name="fields[{{ $uid }}][multiple]"/>
</x-container>