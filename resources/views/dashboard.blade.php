<x-layouts::app.sidebar title="Inicio">
    <flux:main>
        <div class="mx-auto max-w-7xl space-y-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Institución Educativa Salvatore</p>
                    <flux:heading size="xl" class="mt-2">Resumen academico</flux:heading>
                    <flux:subheading class="mt-1">Consulta rapidamente el estado de tu comunidad escolar.</flux:subheading>
                </div>
                <div class="flex items-center gap-2 text-sm text-zinc-500"><span class="size-2 rounded-full bg-[#c49a35]"></span> Sistema activo</div>
            </div>

            <section class="relative isolate min-h-56 overflow-hidden rounded-2xl bg-[#27313a] shadow-[0_10px_28px_rgba(39,49,58,0.14)] sm:min-h-64">
                <img src="{{ asset('images/fondo.jpg') }}" alt="Campus de la Institución Educativa Salvatore" class="absolute inset-0 -z-20 size-full object-cover object-center opacity-75" />
                <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#172028]/95 via-[#27313a]/65 to-[#27313a]/15"></div>
                <div class="flex min-h-56 max-w-xl flex-col justify-center p-6 text-white sm:min-h-64 sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#e2c66f]">Comunidad educativa</p>
                    <h2 class="mt-3 text-2xl font-semibold tracking-tight sm:text-3xl">Un colegio organizado para aprender mejor.</h2>
                    <p class="mt-3 max-w-md text-sm leading-6 text-white/80">Encuentra en un solo lugar la información académica, los cursos y el seguimiento de tus estudiantes.</p>
                </div>
            </section>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                @foreach([
                    ['Estudiantes', 'Gestiona matriculas y datos personales.', 'estudiantes.index', 'academic-cap'],
                    ['Profesores', 'Consulta el equipo docente.', 'profesores.index', 'user-group'],
                    ['Cursos', 'Organiza grados y jornadas.', 'cursos.index', 'rectangle-stack'],
                    ['Evaluacion', 'Periodos, escalas e indicadores.', 'periodos.index', 'chart-bar'],
                ] as [$title, $description, $routeName, $icon])
                    @if(Route::has($routeName))
                        <a href="{{ route($routeName) }}" wire:navigate class="group rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(39,49,58,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                            <div class="flex items-center justify-between"><span class="flex size-10 items-center justify-center rounded-xl bg-[#eef1f5] text-[#27313a] dark:bg-[#39434b] dark:text-[#d8b85c]"><flux:icon :name="$icon" class="size-5" /></span><flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" /></div>
                            <h2 class="mt-5 font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h2>
                            <p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
                        </a>
                    @endif
                @endforeach
            </div>

            <section>
                <div class="mb-4 flex items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Vida escolar</p>
                        <h2 class="mt-1 text-xl font-semibold text-[#27313a] dark:text-zinc-100">Aprender también es compartir</h2>
                    </div>
                    <span class="hidden text-sm text-zinc-500 sm:block">Un espacio para nuestra comunidad</span>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    <article class="group overflow-hidden rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(39,49,58,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="relative h-44 overflow-hidden"><img src="{{ asset('images/ninos-aula.jpg') }}" alt="Niños aprendiendo en el aula" class="size-full object-cover transition duration-500 group-hover:scale-105" /><div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-black/45 to-transparent"></div></div>
                        <div class="p-4"><h3 class="font-semibold text-[#27313a] dark:text-zinc-100">Nuestra aula</h3><p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">Un entorno preparado para descubrir y participar.</p></div>
                    </article>
                    <article class="group overflow-hidden rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(39,49,58,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="relative h-44 overflow-hidden"><img src="{{ asset('images/ninos-lectura.jpg') }}" alt="Niños compartiendo una lectura" class="size-full object-cover transition duration-500 group-hover:scale-105" /><div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-black/45 to-transparent"></div></div>
                        <div class="p-4"><h3 class="font-semibold text-[#27313a] dark:text-zinc-100">Lectura compartida</h3><p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">Cada historia abre una nueva forma de aprender.</p></div>
                    </article>
                    <article class="group overflow-hidden rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(39,49,58,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="relative h-44 overflow-hidden"><img src="{{ asset('images/actividades-colegio.jpg') }}" alt="Niños realizando una actividad escolar" class="size-full object-cover transition duration-500 group-hover:scale-105" /><div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-black/45 to-transparent"></div></div>
                        <div class="p-4"><h3 class="font-semibold text-[#27313a] dark:text-zinc-100">Manos a la obra</h3><p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">Explorar, crear y resolver juntos.</p></div>
                    </article>
                </div>
            </section>

            <section class="rounded-2xl border border-[#dce8dc] bg-white p-6 shadow-[0_8px_24px_rgba(43,83,50,0.06)] dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between"><div><h2 class="font-semibold">Accesos frecuentes</h2><p class="mt-1 text-sm text-zinc-500">Continúa con las tareas habituales de la institución.</p></div><span class="rounded-full bg-[#f8f1dc] px-3 py-1 text-xs font-medium text-[#8a681b]">Gestión escolar</span></div>
                <div class="mt-6 grid gap-3 sm:grid-cols-3">
                    @foreach([['Crear estudiante','estudiantes.create'],['Registrar profesor','profesores.create'],['Ver periodos','periodos.index']] as [$label, $routeName])
                        @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="flex items-center justify-between rounded-xl bg-[#f5f7fa] px-4 py-3 text-sm font-medium text-[#27313a] transition hover:bg-[#eef1f5] dark:bg-zinc-800 dark:text-[#d8b85c]"><span>{{ $label }}</span><flux:icon name="chevron-right" class="size-4" /></a>@endif
                    @endforeach
                </div>
            </section>
        </div>
    </flux:main>
</x-layouts::app>
