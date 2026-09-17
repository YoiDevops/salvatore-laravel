<x-layouts::app title="Cursos">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Cursos</flux:heading>
                <flux:subheading class="mt-1">Cursos y grupos activos en la institución.</flux:subheading>
            </div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                <span class="size-2 rounded-full bg-[#c49a35]"></span> {{ $cursos->count() }} {{ Str::plural('curso', $cursos->count()) }}
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @forelse($cursos as $curso)
                @php($enCurso = ($curso->ano_lectivo ?? null) == date('Y'))
                <div class="rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $enCurso ? 'bg-[#e8f2e8] text-[#2f6f48]' : 'bg-zinc-100 text-zinc-500 dark:bg-zinc-800' }}">
                            <span class="size-1.5 rounded-full {{ $enCurso ? 'bg-[#3f9d63]' : 'bg-zinc-400' }}"></span>
                            {{ $enCurso ? 'En ejecución' : ($curso->ano_lectivo ? 'Año '.$curso->ano_lectivo : 'Sin año lectivo') }}
                        </span>
                        <flux:icon name="rectangle-stack" class="size-5 text-[#a46b21]" />
                    </div>

                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Curso {{ $curso->id_curso }}</p>
                    <h3 class="mt-1 text-lg font-bold text-zinc-900 dark:text-zinc-100">{{ $curso->nombre_curso }} &middot; {{ $curso->grado->nombre_grado ?? 'N/D' }}</h3>

                    <div class="mt-3 flex flex-wrap gap-x-4 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400">
                        <span class="flex items-center gap-1"><flux:icon name="building-library" class="size-4" /> {{ $curso->sede->nombre_sede ?? 'Sede N/D' }}</span>
                        <span class="flex items-center gap-1"><flux:icon name="clock" class="size-4" /> {{ $curso->jornada ?? 'Jornada N/D' }}</span>
                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-zinc-100 pt-4 dark:border-zinc-800">
                        <span class="flex items-center gap-2 text-sm font-medium text-zinc-600 dark:text-zinc-300">
                            <flux:icon name="academic-cap" class="size-4 text-[#526da8]" />
                            {{ $curso->estudiantes->count() }} {{ Str::plural('aprendiz', $curso->estudiantes->count()) }}
                        </span>
                        <flux:button size="sm" href="{{ route('profesor.cursos.show', $curso->id_curso) }}" wire:navigate>
                            Ver curso
                        </flux:button>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-zinc-200 bg-white p-10 text-center text-sm text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900">
                    No hay cursos registrados todavía.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
