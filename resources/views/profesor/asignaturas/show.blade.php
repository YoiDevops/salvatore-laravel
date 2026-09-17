<x-layouts::app title="Detalle de la asignatura">
    <div class="mx-auto max-w-4xl space-y-6">
        <a href="{{ route('profesor.asignaturas.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a asignaturas
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">{{ $asignatura->area->nombre_area ?? 'Sin área' }}</p>
            <h2 class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $asignatura->nombre_asignatura }}</h2>
            <p class="mt-2 text-sm leading-6 text-zinc-500">{{ $asignatura->descripcion ?? 'Sin descripción registrada.' }}</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Intensidad horaria</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $asignatura->intensidad_horaria }}h</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Porcentaje del área</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $asignatura->porcentaje_area ?? 'N/D' }}{{ $asignatura->porcentaje_area ? '%' : '' }}</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Indicadores</p>
                    <p class="mt-1 text-2xl font-bold text-zinc-900 dark:text-zinc-100">{{ $asignatura->indicadoresLogro->count() }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-100 p-6 dark:border-zinc-800">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Indicadores de logro</h3>
                <p class="mt-1 text-sm text-zinc-500">Definidos para esta asignatura.</p>
            </div>
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @forelse($asignatura->indicadoresLogro as $indicador)
                    <a href="{{ route('profesor.indicadores.show', $indicador->id_indicador) }}" wire:navigate class="flex items-center justify-between gap-4 p-5 transition hover:bg-[#fffaf0]">
                        <div>
                            <p class="font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->descripcion_logro }}</p>
                            <p class="mt-1 text-xs text-zinc-500">{{ $indicador->periodo->nombre_periodo ?? 'Sin periodo' }} &middot; {{ $indicador->escalaValoracion->nombre_desempeno ?? 'Sin escala' }}</p>
                        </div>
                        <flux:icon name="chevron-right" class="size-4 shrink-0 text-zinc-400" />
                    </a>
                @empty
                    <p class="p-6 text-center text-sm text-zinc-500">Esta asignatura aún no tiene indicadores de logro registrados.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>
