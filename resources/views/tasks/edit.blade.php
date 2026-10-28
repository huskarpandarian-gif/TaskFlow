@extends('layouts.app')

@section('title', 'Editar tarea')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- Encabezado --}}
    <div class="mb-6 flex items-center justify-between gap-4">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('tasks.index') }}" class="transition hover:text-indigo-600">
                    Mis tareas
                </a>

                <span>/</span>

                <span>Editar</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Editar tarea
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Modifica la información de tu tarea y guarda los cambios.
            </p>
        </div>

        <a
            href="{{ route('tasks.index') }}"
            class="inline-flex shrink-0 items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>

            Volver
        </a>

    </div>

    {{-- Formulario --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
            <h2 class="text-base font-semibold text-slate-900">
                Información de la tarea
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Actualiza los campos que necesites.
            </p>
        </div>

        <div class="p-6 sm:p-8">

            {{-- Errores generales --}}
            @if ($errors->any())
                <div
                    role="alert"
                    class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700"
                >
                    <div class="flex items-start gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="mt-0.5 h-5 w-5 shrink-0"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                        </svg>

                        <div>
                            <p class="font-semibold">
                                No se pudieron guardar los cambios.
                            </p>

                            <p class="mt-1">
                                Revisa los siguientes errores:
                            </p>

                            <ul class="mt-2 list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endif

            <form
                action="{{ route('tasks.update', $task->id) }}"
                method="POST"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- Título --}}
                <div>
                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Título <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $task->title) }}"
                        maxlength="255"
                        required
                        placeholder="Ej. Preparar informe mensual"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('title') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                    >

                    @error('title')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div>
                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Descripción
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Describe los detalles de la tarea..."
                        class="block w-full resize-y rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('description') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                    >{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Prioridad y estado --}}
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                    <div>
                        <label
                            for="priority"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Prioridad <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="priority"
                            name="priority"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('priority') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                            @foreach ($priorities as $priority)
                                <option
                                    value="{{ $priority->value }}"
                                    @selected(
                                        old('priority', $task->priority->value)
                                        === $priority->value
                                    )
                                >
                                    {{ ucfirst(str_replace('_', ' ', $priority->value)) }}
                                </option>
                            @endforeach
                        </select>

                        @error('priority')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label
                            for="status"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Estado <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('status') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                            @foreach ($statuses as $status)
                                <option
                                    value="{{ $status->value }}"
                                    @selected(
                                        old('status', $task->status->value)
                                        === $status->value
                                    )
                                >
                                    {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Fecha límite --}}
                <div>
                    <label
                        for="due_date"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Fecha límite
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('due_date') border-red-500 focus:border-red-500 focus:ring-red-100 @enderror"
                    >

                    @error('due_date')
                        <p class="mt-1.5 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Acciones --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>

                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

    <p class="mt-4 text-center text-xs text-slate-400">
        Los cambios se aplicarán cuando guardes la tarea.
    </p>

</div>

@endsection