@props([
    'label' => false,
    'code' => '',
    'source' => '',
])

<div class="mb-4 relative">
    @if ($label)
        <label class="text-gray-600">{{ $label }}</label>
    @endif
    <div class="w-full flex gap-2 border rounded p-4 mb-2" id="{{ $code }}-selected">
        {{ $slot }}
    </div>
    <x-input placeholder="Поиск" class="mb-0" id="{{ $code }}-search" 
        hx-get="{{ $source }}"
        hx-target="#{{ $code }}-select"
    />
    <div class="absolute w-full border bg-white rounded hidden" id="{{ $code }}-select">
    </div>
</div>

<script>
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
</script>