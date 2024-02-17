<div id="{{ $id }}">
    <div class="absolute top-0 left-0 w-full h-screen bg-black opacity-15"></div>
    <div class="absolute top-0 left-0 w-full h-screen" id="modal-back">
        <div class="mt-[10%] mx-auto w-1/3 bg-white rounded p-4">
           {{ $slot }}
        </div>
    </div>
</div>

<script>
    document.getElementById('modal-back').addEventListener('click', (e) => {
        if (e.currentTarget !== e.target) {
            return
        }

        document.querySelector('#modal').remove()
    })
</script>