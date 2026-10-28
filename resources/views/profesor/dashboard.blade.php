<x-layouts::app title="Panel del docente">
    <div class="mx-auto max-w-7xl space-y-10">
        {{-- Banner Principal --}}
        <section class="relative isolate grid overflow-hidden rounded-3xl border border-[#e8e2d8] border-t-4 border-t-[#d8b85c] bg-[#fbfaf7] shadow-[0_18px_50px_rgba(39,49,58,0.10)] dark:border-[#3c4043] dark:border-t-[#d8b85c] dark:bg-[#1e1f20] lg:min-h-[390px] lg:grid-cols-[1.05fr_0.95fr]">
            <div class="relative z-10 flex flex-col items-start justify-center px-6 py-8 sm:px-10 sm:py-12 lg:px-12">
                <p class="inline-flex items-center gap-2 border-b border-[#d6ad4b]/50 pb-2 text-xs font-bold uppercase tracking-[0.18em] text-[#82631d] dark:text-[#e6c96f]">
                    <span aria-hidden="true">✦</span> Tu aventura docente
                </p>
                <h1 class="mt-5 max-w-xl text-3xl font-extrabold leading-tight text-[#27313a] sm:text-4xl dark:text-[#f1f3f4]">
                    Hola, {{ auth()->user()->name }}. <span class="text-[#9a761f] dark:text-[#e6c96f]">Hoy también es un gran día para enseñar.</span>
                </h1>
                <p class="mt-4 max-w-lg text-base leading-7 text-[#53606b] dark:text-[#bdc1c6]">
                    Organiza tus cursos, acompaña a tus estudiantes y celebra cada nuevo descubrimiento.
                </p>
                <div class="mt-7 flex flex-wrap gap-3">
                    @if(Route::has('profesor.cursos.index'))
                        <a href="{{ route('profesor.cursos.index') }}" wire:navigate class="inline-flex min-h-12 items-center justify-center gap-2 rounded-full bg-[#d8b85c] px-6 py-3 font-bold text-[#27313a] shadow-lg shadow-[#d8b85c]/20 transition hover:-translate-y-0.5 hover:bg-[#e6c96f]">
                            Explorar mis cursos <span aria-hidden="true">→</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="relative min-h-64 overflow-hidden lg:min-h-full">
                <img src="{{ asset('images/aventura-salvatore.jpg') }}" alt="Estudiantes leyendo, creando y explorando juntos" class="absolute inset-0 size-full object-cover" loading="eager" decoding="async">
                <div class="absolute inset-0 bg-gradient-to-t from-[#27313a]/35 via-transparent to-transparent lg:bg-gradient-to-r lg:from-[#fbfaf7] lg:via-[#fbfaf7]/20 lg:to-transparent dark:lg:from-[#1e1f20]"></div>
                <span class="absolute right-6 top-5 text-3xl text-white drop-shadow" aria-hidden="true">✦</span>
            </div>
        </section>

        <section aria-label="Gestión docente" class="pt-4">
            {{-- Encabezado Centrado --}}
            <div class="mb-8 text-center">
                <p class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-[0.2em] text-[#9a761f] dark:text-[#e6c96f]">
                    <span class="h-0.5 w-6 bg-[#9a761f] dark:bg-[#e6c96f]"></span>
                    QUÉ HACEMOS
                    <span class="h-0.5 w-6 bg-[#9a761f] dark:bg-[#e6c96f]"></span>
                </p>
                <h2 class="mt-2 text-2xl font-black uppercase tracking-tight text-[#27313a] dark:text-zinc-100 sm:text-3xl">
                    HERRAMIENTAS DE <span class="text-[#9a761f] dark:text-[#e6c96f]">GESTIÓN DOCENTE.</span>
                </h2>
            </div>

            <div class="overflow-hidden rounded-2xl border border-[#e8e2d8] border-t-4 border-t-[#d8b85c] bg-white shadow-md dark:border-[#3c4043] dark:border-t-[#d8b85c] dark:bg-[#1e1f20]">
                <div class="grid divide-y divide-[#e8e2d8] sm:grid-cols-2 sm:divide-y-0 sm:divide-x dark:divide-[#3c4043] lg:grid-cols-4">
                    @foreach([
                        ['CURSOS', 'Espacios para enseñar y compartir ideas.', 'profesor.cursos.index', 'rectangle-stack', $stats['cursos']],
                        ['ESTUDIANTES', 'Historias por acompañar.', 'profesor.estudiantes.index', 'academic-cap', $stats['estudiantes']],
                        ['ASIGNATURAS', 'Mundos por descubrir.', 'profesor.asignaturas.index', 'book-open', $stats['asignaturas']],
                        ['GRADOS', 'Etapas de crecimiento.', 'profesor.grados.index', 'bookmark', $stats['grados']],
                    ] as [$title, $description, $routeName, $icon, $count])
                        @if(Route::has($routeName))
                            <a href="{{ route($routeName) }}" wire:navigate class="group flex flex-col items-center justify-between p-8 text-center transition duration-300 hover:bg-[#fbfaf7] dark:hover:bg-[#252628]">
                                <div class="flex flex-col items-center">
                                    <div class="mb-5 flex size-14 items-center justify-center text-[#53606b] transition duration-300 group-hover:scale-110 group-hover:text-[#9a761f] dark:text-zinc-400 dark:group-hover:text-[#e6c96f]">
                                        <flux:icon :name="$icon" class="size-10" />
                                    </div>
                                    <p class="mb-2 text-3xl font-extrabold tabular-nums text-[#27313a] dark:text-zinc-100">{{ $count }}</p>
                                    <h3 class="text-sm font-extrabold uppercase tracking-wide text-[#27313a] dark:text-zinc-100">
                                        {{ $title }}
                                    </h3>
                                    <p class="mt-3 text-xs leading-relaxed text-[#66717b] dark:text-zinc-400">
                                        {{ $description }}
                                    </p>
                                </div>
                                <div class="mt-6 h-0.5 w-8 bg-[#d8b85c] opacity-40 transition-all duration-300 group-hover:w-16 group-hover:opacity-100"></div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layouts::app>