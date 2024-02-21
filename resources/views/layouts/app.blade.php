<html>
    <head>
        <meta charset="utf-8">
        <title>ultraCMS</title>
        <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-100">
        <div class="flex w-full min-h-screen fixed">
            <div class="w-96 bg-white text-xl shadow">
                <div class="w-2/3 mx-auto mt-28 space-y-2 flex flex-col">
                    <a href="{{ route('categories.create') }}" class="p-3 rounded hover:shadow">Категории</a>
                    <a href="{{ route('pages.create') }}" class="p-3 rounded hover:shadow">Страницы</a>
                    <a href="{{ route('components.create') }}" class="p-3 rounded hover:shadow">Конструктор</a>
                </div>
                <div class="w-full h-[2px] my-8 bg-slate-100"></div>
                <div class="w-2/3 mx-auto space-y-2 flex flex-col">
                    <label class="p-3 rounded font-semibold">Компоненты</label>
                </div>
            </div>
            <div class="w-10/12 ">
                <div class="h-screen overflow-y-auto">
                    @yield('body')
                </div>
            </div>
        </div>
    </body>
</html>