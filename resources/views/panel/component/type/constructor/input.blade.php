<div> INPUT
    <div class="p-4 border rounded shadow">
        <x-input value="input" label="" name="fields[{{ $uid }}][type]" hidden/>
        
        <x-input label="Название (уникальный код)" value="{{ $field['code'] ?? '' }}" name="fields[{{ $uid }}][code]"/>
        <x-input label="Подпись при заполнении" value="{{ $field['label'] ?? '' }}" name="fields[{{ $uid }}][label]"/>
        <x-input label="Значение по умолчанию" value="{{ $field['default'] ?? '' }}" name="fields[{{ $uid }}][default]"/>

        <x-checkbox label="Обязательное поле" name="fields[{{ $uid }}][required]"/> 
        <x-checkbox label="Коллекция" name="fields[{{ $uid }}][multiple]"/>
    </div>
</div>