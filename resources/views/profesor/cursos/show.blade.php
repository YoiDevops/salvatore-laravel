<x-layouts::app title="Detalle del curso">
    <div class="mx-auto max-w-7xl space-y-6">
        <a href="{{ route('profesor.cursos.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a cursos
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                <div>
                    @php($enCurso = ($curso->ano_lectivo ?? null) == date('Y'))
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">Curso {{ $curso->id_curso }}</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $enCurso ? 'bg-[#e8f2e8] text-[#2f6f48]' : 'bg-zinc-100 text-zinc-500 dark:bg-zinc-800' }}">
                            <span class="size-1.5 rounded-full {{ $enCurso ? 'bg-[#3f9d63]' : 'bg-zinc-400' }}"></span>
                            {{ $enCurso ? 'En ejecución' : ($curso->ano_lectivo ? 'Año '.$curso->ano_lectivo : 'Sin año lectivo') }}
                        </span>
                    </div>
                    <h2 class="mt-3 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $curso->nombre_curso }} &middot; {{ $curso->grado->nombre_grado ?? 'N/D' }}</h2>
                </div>

                <div class="text-left sm:text-right">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Sede</p>
                    <p class="mt-1 font-semibold text-zinc-800 dark:text-zinc-100">{{ $curso->sede->nombre_sede ?? 'N/D' }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Total estudiantes</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $curso->estudiantes->count() }}</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Jornada</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $curso->jornada ?? 'N/D' }}</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Cupo máximo</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $curso->cupo_maximo ?? 'N/D' }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center justify-between border-b border-zinc-100 p-6 dark:border-zinc-800">
                <div>
                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Estudiantes del curso</h3>
                    <p class="mt-1 text-sm text-zinc-500">Listado de estudiantes matriculados.</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/60">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Estudiante &amp; documento</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Género</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Fecha nacimiento</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Estado</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($curso->estudiantes as $estudiante)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="p-4">
                                    <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $estudiante->nombres_estudiante }} {{ $estudiante->apellidos_estudiante }}</p>
                                    <p class="text-xs text-zinc-500">{{ $estudiante->tipo_documento }} {{ $estudiante->documento_identidad }}</p>
                                </td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $estudiante->genero ?? 'N/D' }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $estudiante->fecha_nacimiento ?? 'N/D' }}</td>
                                <td class="p-4">
                                    <span class="rounded-full bg-[#e8f2e8] px-3 py-1 text-xs font-semibold text-[#2f6f48]">{{ $estudiante->estado_estudiante ?? 'Activo' }}</span>
                                </td>
                                <td class="p-4 text-right">
                                    <flux:button size="sm" href="{{ route('profesor.estudiantes.show', $estudiante->id_estudiante) }}" wire:navigate>Ver</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-zinc-500">No hay estudiantes matriculados en este curso.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
