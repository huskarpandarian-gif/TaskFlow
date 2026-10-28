@extends('layouts.app')

@section('title', 'Crear tarea')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Crear tarea
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Completa los datos para registrar una nueva tarea.
            </p>
        </div>

        <a href="{{ route('tasks.index') }}"
            class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
            Volver
        </a>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <strong>Revisa los siguientes errores:</strong>

                <ul class="mt-2 list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-slate-700">
                    Título
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}"
                    maxlength="255"
                    placeholder="Ej. Preparar informe mensual"
                >

                @error('title')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-slate-700">
                    Descripción
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('description') border-red-500 @enderror"
                    placeholder="Describe los detalles de la tarea..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                <div>
                    <label for="priority" class="mb-2 block text-sm font-medium text-slate-700">
                        Prioridad
                    </label>

                    <select
                        id="priority"
                        name="priority"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('priority') border-red-500 @enderror"
                    >
                        <option value="">Selecciona una prioridad</option>

                        @foreach ($priorities as $priority)
                            <option
                                value="{{ $priority->value }}"
                                @selected(old('priority', 'medium') === $priority->value)
                            >
                                {{ ucfirst(str_replace('_', ' ', $priority->value)) }}
                            </option>
                        @endforeach
                    </select>

                    @error('priority')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                        Estado
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="block w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('status') border-red-500 @enderror"
                    >
                        @foreach ($statuses as $status)
                            <option
                                value="{{ $status->value }}"
                                @selected(old('status', 'pending') === $status->value)
                            >
                                {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                            </option>
                        @endforeach
                    </select>

                    @error('status')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div>
                <label for="due_date" class="mb-2 block text-sm font-medium text-slate-700">
                    Fecha límite
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 @error('due_date') border-red-500 @enderror"
                    value="{{ old('due_date') }}"
                >

                @error('due_date')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                <a href="{{ route('tasks.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Crear tarea
                </button>

            </div>

        </form>

    </div>

</div>

@endsection