<x-layouts::app title="Panel del docente">
    <div class="mx-auto max-w-7xl space-y-8">
        <section class="profesor-hero">
            <img src="{{ asset('images/fondo.jpg') }}" alt="Campus de la Institución Educativa Salvatore" loading="eager" decoding="async">
            <div class="profesor-hero-content">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#f4d77a]">Panel docente</p>
                <h1 class="mt-3 text-3xl font-bold sm:text-5xl">Tu espacio para enseñar y evaluar</h1>
                <p class="mt-3 max-w-xl text-base leading-7 text-white/85 sm:text-lg">Consulta la información académica de tus cursos, estudiantes y asignaturas desde un solo lugar.</p>
            </div>
        </section>

        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Hola, {{ auth()->user()->name }}</flux:heading>
                <flux:subheading class="mt-1">Consulta la información académica de tus cursos y estudiantes.</flux:subheading>
            </div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                <span class="size-2 rounded-full bg-[#c49a35]"></span> Ciclo escolar en curso
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([
                ['Cursos', $stats['cursos'].' registrados', 'profesor.cursos.index', 'rectangle-stack', 'bg-[#fbf1df] text-[#a46b21]'],
                ['Estudiantes', $stats['estudiantes'].' matriculados', 'profesor.estudiantes.index', 'academic-cap', 'bg-[#e8f2e8] text-[#2f6f48]'],
                ['Asignaturas', $stats['asignaturas'].' activas', 'profesor.asignaturas.index', 'book-open', 'bg-[#edf1fa] text-[#526da8]'],
                ['Grados', $stats['grados'].' niveles', 'profesor.grados.index', 'bookmark', 'bg-[#f5eaf2] text-[#985278]'],
            ] as [$title, $description, $routeName, $icon, $color])
                @if(Route::has($routeName))
                    <a href="{{ route($routeName) }}" wire:navigate class="group rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="flex items-center justify-between">
                            <span class="flex size-11 items-center justify-center rounded-xl {{ $color }}"><flux:icon :name="$icon" class="size-5" /></span>
                            <flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" />
                        </div>
                        <h2 class="mt-5 font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h2>
                        <p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
            <section class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold">Mi gestión académica</h2>
                        <p class="mt-1 text-sm text-zinc-500">Accede a la información de tus cursos y estudiantes.</p>
                    </div>
                    <flux:icon name="academic-cap" class="size-6 text-[#9a761f]" />
                </div>
                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    @foreach([
                        ['Estudiantes', 'profesor.estudiantes.index', 'academic-cap'],
                        ['Cursos', 'profesor.cursos.index', 'rectangle-stack'],
                        ['Grados', 'profesor.grados.index', 'bookmark'],
                        ['Asignaturas', 'profesor.asignaturas.index', 'book-open'],
                    ] as [$label, $routeName, $icon])
                        @if(Route::has($routeName))
                            <a href="{{ route($routeName) }}" wire:navigate class="flex items-center gap-3 rounded-xl border border-zinc-100 px-4 py-3 text-sm font-medium text-zinc-700 transition hover:border-[#c49a35] hover:bg-[#fffaf0] dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800">
                                <span class="flex size-8 items-center justify-center rounded-lg bg-[#eef1f5] text-[#10213b] dark:bg-[#253653] dark:text-[#d8b85c]"><flux:icon :name="$icon" class="size-4" /></span>
                                {{ $label }}
                                <flux:icon name="chevron-right" class="ml-auto size-4 text-zinc-400" />
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>

            <section class="rounded-2xl border border-[#e6d6a8] bg-[#fffaf0] p-6 dark:border-[#665322] dark:bg-[#2e2714]">
                <div class="flex size-10 items-center justify-center rounded-xl bg-white text-[#9a761f] shadow-sm dark:bg-[#443a1c] dark:text-[#d8b85c]"><flux:icon name="sparkles" class="size-5" /></div>
                <h2 class="mt-5 font-semibold text-[#5d4611] dark:text-[#f0d98b]">Evaluación</h2>
                <p class="mt-2 text-sm leading-6 text-[#7e6b3b] dark:text-[#d8c78d]">Consulta las escalas de valoración y los indicadores de logro definidos para tus asignaturas.</p>
                <div class="mt-6 space-y-2">
                    @foreach([['Indicadores de logro','profesor.indicadores.index'],['Escalas de valoracion','profesor.escalas.index']] as [$label, $routeName])
                        @if(Route::has($routeName))
                            <a href="{{ route($routeName) }}" wire:navigate class="flex items-center justify-between border-b border-[#e6d6a8] py-2 text-sm font-medium text-[#8a681b] last:border-0 dark:border-[#665322] dark:text-[#d8b85c]">
                                <span>{{ $label }}</span>
                                <flux:icon name="arrow-up-right" class="size-4" />
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-layouts::app>
