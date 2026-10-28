@extends('layouts.app')

@section('title', 'Mis tareas | TaskFlow')

@section('content')

<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

        <div>
            <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                ORGANIZACIÓN PERSONAL
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Mis tareas
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Organiza tus actividades, controla tus prioridades y cumple tus objetivos.
            </p>
        </div>

        <a
            href="{{ route('tasks.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
            </svg>

            Nueva tarea
        </a>

    </div>

    {{-- Mensajes de sesión --}}
    @if (session('success'))
        <div
            role="status"
            class="flex items-start justify-between gap-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800"
        >
            <div class="flex items-start gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="mt-0.5 h-5 w-5 shrink-0"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6"/>
                </svg>

                <p>{{ session('success') }}</p>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="rounded-md px-2 text-lg leading-none text-emerald-700 hover:bg-emerald-100"
                aria-label="Cerrar mensaje"
            >
                &times;
            </button>
        </div>
    @endif

    @if (session('error'))
        <div
            role="alert"
            class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 shrink-0"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
            </svg>

            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Resumen --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Tareas encontradas
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $tasks->total() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Según los filtros aplicados
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Página actual
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $tasks->currentPage() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                De {{ $tasks->lastPage() }} página(s)
            </p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">
                Resultados por página
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $tasks->count() }}
            </p>

            <p class="mt-1 text-xs text-slate-400">
                Tareas visibles en esta página
            </p>
        </div>

    </div>

    {{-- Filtros --}}
    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="font-semibold text-slate-900">
                Filtrar tareas
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Encuentra tareas según su estado o prioridad.
            </p>
        </div>

        <form action="{{ route('tasks.index') }}" method="GET" class="p-6">

            <div class="grid grid-cols-1 items-end gap-5 md:grid-cols-3">

                {{-- Estado --}}
                <div>
                    <label
                        for="status"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Estado
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >
                        <option value="">Todos los estados</option>

                        @foreach (\App\Enums\TaskStatus::cases() as $status)
                            <option
                                value="{{ $status->value }}"
                                @selected(request('status') === $status->value)
                            >
                                {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Prioridad --}}
                <div>
                    <label
                        for="priority"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Prioridad
                    </label>

                    <select
                        name="priority"
                        id="priority"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >
                        <option value="">Todas las prioridades</option>

                        @foreach (\App\Enums\TaskPriority::cases() as $priority)
                            <option
                                value="{{ $priority->value }}"
                                @selected(request('priority') === $priority->value)
                            >
                                {{ ucfirst(str_replace('_', ' ', $priority->value)) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Acciones de filtros --}}
                <div class="flex flex-col gap-3 sm:flex-row">

                    <button
                        type="submit"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"/>
                        </svg>

                        Filtrar
                    </button>

                    <a
                        href="{{ route('tasks.index') }}"
                        class="inline-flex flex-1 items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                    >
                        Limpiar
                    </a>

                </div>

            </div>

        </form>

    </section>

    {{-- Listado de tareas --}}
    <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col justify-between gap-2 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center">

            <div>
                <h2 class="font-semibold text-slate-900">
                    Listado de tareas
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulta y administra tus actividades.
                </p>
            </div>

            <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                {{ $tasks->total() }} resultado(s)
            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200 text-left">

                <thead class="bg-slate-50">

                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Tarea
                        </th>

                        <th scope="col" class="whitespace-nowrap px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Prioridad
                        </th>

                        <th scope="col" class="whitespace-nowrap px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Estado
                        </th>

                        <th scope="col" class="whitespace-nowrap px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Fecha límite
                        </th>

                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Acciones
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($tasks as $task)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Título y descripción --}}
                            <td class="min-w-56 px-6 py-4">

                                <p class="font-semibold text-slate-900">
                                    {{ $task->title }}
                                </p>

                                @if ($task->description)
                                    <p class="mt-1 max-w-xs text-sm leading-5 text-slate-500">
                                        {{ \Illuminate\Support\Str::limit($task->description, 70) }}
                                    </p>
                                @endif

                            </td>

                            {{-- Prioridad --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @switch($task->priority->value)

                                    @case('high')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                            Alta
                                        </span>
                                        @break

                                    @case('medium')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                            Media
                                        </span>
                                        @break

                                    @case('low')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                            Baja
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            {{ $task->priority->value }}
                                        </span>

                                @endswitch

                            </td>

                            {{-- Estado --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @switch($task->status->value)

                                    @case('pending')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                                            Pendiente
                                        </span>
                                        @break

                                    @case('in_progress')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                            En progreso
                                        </span>
                                        @break

                                    @case('completed')
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Completada
                                        </span>
                                        @break

                                    @default
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            {{ $task->status->value }}
                                        </span>

                                @endswitch

                            </td>

                            {{-- Fecha límite --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">

                                @if ($task->due_date)
                                    <span>
                                        {{ $task->due_date->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        Sin fecha
                                    </span>
                                @endif

                            </td>

                            {{-- Acciones --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('tasks.show', $task->id) }}"
                                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('tasks.edit', $task->id) }}"
                                        class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-amber-200 hover:bg-amber-50 hover:text-amber-700"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('tasks.destroy', $task->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-7 w-7"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5">
                                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 13h8m-8 4h5"/>
                                    </svg>

                                </div>

                                <h3 class="mt-4 font-semibold text-slate-900">
                                    No se encontraron tareas
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    No hay tareas que coincidan con los filtros seleccionados.
                                </p>

                                <a
                                    href="{{ route('tasks.create') }}"
                                    class="mt-5 inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                >
                                    Crear nueva tarea
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Paginación --}}
        @if ($tasks->hasPages())

            <div class="border-t border-slate-100 px-6 py-5">

                <div class="mb-3 text-sm text-slate-500">
                    Mostrando {{ $tasks->firstItem() ?? 0 }}
                    a {{ $tasks->lastItem() ?? 0 }}
                    de {{ $tasks->total() }} resultados.
                </div>

                {{ $tasks->links('components.pagination') }}

            </div>

        @endif

    </section>

</div>

@endsection