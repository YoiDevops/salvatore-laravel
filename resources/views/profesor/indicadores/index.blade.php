<x-layouts::app title="Indicadores de logro">
    <div class="mx-auto max-w-6xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Indicadores de logro</flux:heading>
                <flux:subheading class="mt-1">Metas de aprendizaje definidas por asignatura y periodo.</flux:subheading>
            </div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                <span class="size-2 rounded-full bg-[#c49a35]"></span> {{ $indicadores->count() }} {{ Str::plural('indicador', $indicadores->count()) }}
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-[#2b2b2b]">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Código</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Descripción</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Asignatura</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Periodo</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Escala</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse($indicadores as $indicador)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="p-4 font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->codigo_logro ?? 'N/D' }}</td>
                                <td class="p-4 max-w-sm truncate text-zinc-600 dark:text-zinc-300">{{ $indicador->descripcion_logro }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $indicador->asignatura->nombre_asignatura ?? 'N/D' }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $indicador->periodo->nombre_periodo ?? 'N/D' }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $indicador->escalaValoracion->nombre_desempeno ?? 'N/D' }}</td>
                                <td class="p-4 text-right">
                                    <flux:button size="sm" href="{{ route('profesor.indicadores.show', $indicador->id_indicador) }}" wire:navigate>Ver</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-zinc-500">No hay indicadores de logro registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
