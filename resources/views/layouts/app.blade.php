<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'TaskFlow')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a href="{{ route('tasks.index') }}"
                class="text-2xl font-bold tracking-tight text-indigo-600">
                TaskFlow
            </a>

            <span class="text-sm font-medium text-slate-500">
                Mis tareas
            </span>

        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        @yield('content')

    </main>

    <footer class="mt-12 border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-4 text-center text-sm text-slate-500">
            TaskFlow &copy; {{ date('Y') }}
        </div>
    </footer>

</body>

</html>