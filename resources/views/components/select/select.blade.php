@props([
    'label' => false,
    'code' => '',
    'source' => '',
    'name' => false,
])

<div class="mb-4 relative">
    @if ($label)
        <label class="text-gray-600">{{ $label }}</label>
    @endif
    <div class="w-full flex flex-wrap gap-2 rounded {{-- mb-2 bg-slate-50 border p-3 --}}" id="{{ $code }}-selected">
        @if (old('_token'))
            @foreach (old($code) ?? [] as $oldVal)
                <x-select.selected selectOptionName="{{ $code }}" value="{{ $oldVal }}"  label="{{ old($code . '_labels')[$loop->index] }}"/>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </div>
    <x-input placeholder="Поиск" class="!mb-0" id="{{ $code }}-search" 
        hx-get="{{ $source }}"
        hx-target="#{{ $code }}-select"
        hx-include="#{{ $code }}-search-data"
    />
    <div id="{{ $code }}-search-data">
        <input type="hidden" name="selectSelectedSelector" value="#{{ $code }}-selected">
        <input type="hidden" name="selectOptionsName" value="{{ $code }}">
    </div>
    <div class="absolute w-full border bg-white rounded hidden z-50" id="{{ $code }}-select"></div>
</div>

<script>
    (() => {
        const search = document.querySelector('#{{ $code }}-search')
        const select = document.querySelector('#{{ $code }}-select')

        search.addEventListener('focus', () => {
            select.classList.remove('hidden')
        })

        document.addEventListener('click', (e) => {
            if (e.target !== select && e.target !== search) {
                select.classList.add('hidden')
            }
        })
    })()
</script>