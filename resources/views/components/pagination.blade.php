@if ($paginator->hasPages())

    <nav
        role="navigation"
        aria-label="Paginación"
        class="flex flex-col gap-4 border-t border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between"
    >

        {{-- Información de resultados --}}
        <p class="text-sm text-slate-500">
            Mostrando
            <span class="font-semibold text-slate-800">
                {{ $paginator->firstItem() ?? 0 }}
            </span>
            a
            <span class="font-semibold text-slate-800">
                {{ $paginator->lastItem() ?? 0 }}
            </span>
            de
            <span class="font-semibold text-slate-800">
                {{ $paginator->total() }}
            </span>
            tareas
        </p>

        {{-- Navegación --}}
        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())

                <span
                    aria-disabled="true"
                    class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm text-slate-300"
                >
                    Anterior
                </span>

            @else

                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                >
                    Anterior
                </a>

            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)

                @if (is_string($element))

                    <span class="px-2 text-sm text-slate-400">
                        {{ $element }}
                    </span>

                @endif

                @if (is_array($element))

                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())

                            <span
                                aria-current="page"
                                class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-indigo-600 px-3 text-sm font-semibold text-white"
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach

                @endif

            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())

                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50"
                >
                    Siguiente
                </a>

            @else

                <span
                    aria-disabled="true"
                    class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm text-slate-300"
                >
                    Siguiente
                </span>

            @endif

        </div>

    </nav>

@endif