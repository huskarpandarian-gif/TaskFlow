@extends('layouts.app')

@section('title', 'Detalle de tarea | TaskFlow')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Navegación --}}
    <div class="flex items-center gap-2 text-sm text-slate-500">
        <a
            href="{{ route('tasks.index') }}"
            class="transition hover:text-indigo-600"
        >
            Mis tareas
        </a>

        <span>/</span>

        <span class="font-medium text-slate-700">
            Detalle de tarea
        </span>
    </div>

    {{-- Encabezado --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                </svg>

                DETALLE DE TAREA
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Información de la tarea
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Consulta los detalles, el estado y las fechas de tu actividad.
            </p>
        </div>

        <a
            href="{{ route('tasks.index') }}"
            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>

            Volver al listado
        </a>

    </div>

    {{-- Tarjeta principal --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Cabecera de la tarea --}}
        <div class="border-b border-slate-100 bg-slate-50/70 px-6 py-6 sm:px-8">

            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-start">

                <div class="min-w-0 flex-1">

                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Título de la tarea
                    </p>

                    <h2 class="break-words text-2xl font-bold text-slate-900">
                        {{ $task->title }}
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Creada el
                        {{ $task->created_at?->format('d/m/Y') ?? 'fecha no disponible' }}
                    </p>

                </div>

                {{-- Indicador de estado --}}
                <div class="shrink-0">

                    @switch($task->status->value)

                        @case('pending')
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-700">
                                <span class="h-2 w-2 rounded-full bg-slate-500"></span>
                                Pendiente
                            </span>
                            @break

                        @case('in_progress')
                            <span class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-700">
                                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                                En progreso
                            </span>
                            @break

                        @case('completed')
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Completada
                            </span>
                            @break

                        @default
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-700">
                                {{ ucfirst(str_replace('_', ' ', $task->status->value)) }}
                            </span>

                    @endswitch

                </div>

            </div>

        </div>

        {{-- Contenido --}}
        <div class="space-y-8 p-6 sm:p-8">

            {{-- Descripción --}}
            <div>

                <h3 class="mb-3 text-sm font-semibold text-slate-900">
                    Descripción
                </h3>

                <div class="rounded-xl border border-slate-200 bg-white p-4">

                    @if ($task->description)

                        <p class="whitespace-pre-line break-words text-sm leading-7 text-slate-600">{{ $task->description }}</p>

                    @else

                        <p class="text-sm italic text-slate-400">
                            Esta tarea no tiene una descripción.
                        </p>

                    @endif

                </div>

            </div>

            {{-- Información general --}}
            <div>

                <h3 class="mb-4 text-sm font-semibold text-slate-900">
                    Información general
                </h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    {{-- Prioridad --}}
                    <div class="rounded-xl border border-slate-200 p-5">

                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m12 3 9 16H3L12 3Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 3h.01"/>
                            </svg>

                        </div>

                        <p class="text-sm text-slate-500">
                            Prioridad
                        </p>

                        <div class="mt-2">

                            @switch($task->priority->value)

                                @case('high')
                                    <span class="inline-flex rounded-lg bg-red-50 px-3 py-1.5 text-sm font-semibold text-red-700">
                                        Alta
                                    </span>
                                    @break

                                @case('medium')
                                    <span class="inline-flex rounded-lg bg-amber-50 px-3 py-1.5 text-sm font-semibold text-amber-700">
                                        Media
                                    </span>
                                    @break

                                @case('low')
                                    <span class="inline-flex rounded-lg bg-sky-50 px-3 py-1.5 text-sm font-semibold text-sky-700">
                                        Baja
                                    </span>
                                    @break

                                @default
                                    <span class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-700">
                                        {{ ucfirst(str_replace('_', ' ', $task->priority->value)) }}
                                    </span>

                            @endswitch

                        </div>

                    </div>

                    {{-- Fecha límite --}}
                    <div class="rounded-xl border border-slate-200 p-5">

                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 3v4M8 3v4M3 11h18"/>
                            </svg>

                        </div>

                        <p class="text-sm text-slate-500">
                            Fecha límite
                        </p>

                        @if ($task->due_date)

                            <p class="mt-2 font-semibold text-slate-900">
                                {{ $task->due_date->format('d/m/Y') }}
                            </p>

                        @else

                            <p class="mt-2 font-medium text-slate-400">
                                Sin fecha límite
                            </p>

                        @endif

                    </div>

                    {{-- Fecha de creación --}}
                    <div class="rounded-xl border border-slate-200 p-5">

                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                            </svg>

                        </div>

                        <p class="text-sm text-slate-500">
                            Fecha de creación
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $task->created_at?->format('d/m/Y H:i') ?? 'No disponible' }}
                        </p>

                    </div>

                    {{-- Última actualización --}}
                    <div class="rounded-xl border border-slate-200 p-5">

                        <div class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7v5h-5M4 17v-5h5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.5 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.5-3"/>
                            </svg>

                        </div>

                        <p class="text-sm text-slate-500">
                            Última actualización
                        </p>

                        <p class="mt-2 font-semibold text-slate-900">
                            {{ $task->updated_at?->format('d/m/Y H:i') ?? 'No disponible' }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Acciones --}}
            <div class="flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-between">

                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2"
                >
                    Volver al listado
                </a>

                <a
                    href="{{ route('tasks.edit', $task->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16 4 4 4M4 20l4-.8L19 8a2.12 2.12 0 0 0-3-3L5 16l-1 4Z"/>
                    </svg>

                    Editar tarea
                </a>

            </div>

        </div>

    </section>

</div>

@endsection