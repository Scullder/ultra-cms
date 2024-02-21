<x-modal id="modal">
    <x-h2>Выбор типа</x-h2>
    <form 
        class="m-0 flex flex-col items-center gap-4" 
        hx-get="{{ route('type.show') }}"
        hx-target="#component-types" 
        hx-swap="beforeend"
    >
        @foreach ($types as $type)
            <div class="w-full">
                <input id="types-select-{{ $type }}" type="radio" name="type" value="{{ $type }}" @checked($loop->first) hidden>
                <label for="types-select-{{ $type }}" class="border rounded block cursor-pointer p-4 select-none">
                    @include("{$typesPath}/preview/{$type}")
                </label>
            </div>
        @endforeach
        <x-button class="w-1/2">выбрать</x-button>
    </form>
</x-modal>

<style>
    input:checked+label {
        border-color: #4f46e5;
    }
</style>

<script>
    document.querySelector('#modal form').addEventListener('submit', (e) => {
        e.preventDefault()
        document.querySelector('#modal').remove()
    })
</script>
