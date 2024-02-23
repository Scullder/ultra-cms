<html>
    <head>
        <meta charset="utf-8">
        <title>ultraCMS</title>
        <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-100">
        <div class="flex w-full min-h-screen fixed">
            <div class="w-80 bg-white text-lg shadow pt-28 ">
                <div class="w-3/5 mx-auto flex flex-col">
                    <label class="p-2 rounded font-semibold">Контент менеджер</label>
                </div>
                <div class="w-3/5 mx-auto space-y-1 mt-2 flex flex-col text-lg">
                    <a href="{{ route('categories.create') }}" class="p-2 rounded hover:shadow">Категории</a>
                    <a href="{{ route('pages.create') }}" class="p-2 rounded hover:shadow">Страницы</a>
                    <a href="{{ route('components.create') }}" class="p-2 rounded hover:shadow">Конструктор</a>
                </div>
                <div class="w-full h-[2px] my-8 bg-slate-100"></div>
                <div class="w-3/5 mx-auto flex flex-col">
                    <label class="p-3 rounded font-semibold">Компоненты</label>
                </div>
            </div>
            <div class="w-full">
                <div class="h-screen overflow-y-auto">
                    @yield('body')
                </div>
            </div>
            {{-- <div class="w-[30%] ">
                <div class="bg-white shadow h-[700px]">
                </div>
            </div> --}}
        </div>
    </body>
</html>