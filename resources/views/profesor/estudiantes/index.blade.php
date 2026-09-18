<x-layouts::app title="Estudiantes">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Estudiantes</flux:heading>
                <flux:subheading class="mt-1">Consulta el listado de estudiantes matriculados.</flux:subheading>
            </div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                <span class="size-2 rounded-full bg-[#c49a35]"></span> {{ $estudiantes->count() }} {{ Str::plural('estudiante', $estudiantes->count()) }}
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-[#2b2b2b]">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Estudiante &amp; documento</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Curso</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Grado</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Género</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Estado</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($estudiantes as $estudiante)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="p-4">
                                    <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $estudiante->nombres_estudiante }} {{ $estudiante->apellidos_estudiante }}</p>
                                    <p class="text-xs text-zinc-500">{{ $estudiante->tipo_documento }} {{ $estudiante->documento_identidad }}</p>
                                </td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $estudiante->curso->nombre_curso ?? 'Sin curso' }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $estudiante->curso->grado->nombre_grado ?? 'N/D' }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $estudiante->genero ?? 'N/D' }}</td>
                                <td class="p-4">
                                    <span class="rounded-full bg-[#e8f2e8] px-3 py-1 text-xs font-semibold text-[#2f6f48]">{{ $estudiante->estado_estudiante ?? 'Activo' }}</span>
                                </td>
                                <td class="p-4 text-right">
                                    <flux:button size="sm" href="{{ route('profesor.estudiantes.show', $estudiante->id_estudiante) }}" wire:navigate>Ver</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-zinc-500">No hay estudiantes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
