<x-layouts::app title="Detalle del indicador">
    <div class="mx-auto max-w-3xl space-y-6">
        <a href="{{ route('profesor.indicadores.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a indicadores
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">{{ $indicador->codigo_logro ?? 'Sin código' }}</p>
            <h2 class="mt-1 text-xl font-bold text-zinc-900 dark:text-zinc-100">{{ $indicador->descripcion_logro }}</h2>
            @if($indicador->tipo_logro)
                <span class="mt-3 inline-block rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">{{ $indicador->tipo_logro }}</span>
            @endif

            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-[#2b2b2b]">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Asignatura</p>
                    <p class="mt-1 font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->asignatura->nombre_asignatura ?? 'N/D' }}</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-[#2b2b2b]">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Periodo</p>
                    <p class="mt-1 font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->periodo->nombre_periodo ?? 'N/D' }}</p>
                </div>
                <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-[#2b2b2b]">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">Escala</p>
                    <p class="mt-1 font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->escalaValoracion->nombre_desempeno ?? 'N/D' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
