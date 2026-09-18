<x-layouts::app title="Detalle de la escala">
    <div class="mx-auto max-w-3xl space-y-6">
        <a href="{{ route('profesor.escalas.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a escalas
        </a>

        @php($colores = ['Superior' => 'bg-[#e8f2e8] text-[#2f6f48]', 'Alto' => 'bg-[#edf1fa] text-[#526da8]', 'Basico' => 'bg-[#fbf1df] text-[#a46b21]', 'Bajo' => 'bg-[#fbe4e4] text-[#a13f3f]'])

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $colores[$escala->nombre_desempeno] ?? 'bg-zinc-100 text-zinc-600' }}">{{ $escala->nombre_desempeno }}</span>
            <h2 class="mt-3 text-xl font-bold text-zinc-900 dark:text-zinc-100">Rango {{ $escala->nota_minima }} — {{ $escala->nota_maxima }}</h2>
            <p class="mt-2 text-sm leading-6 text-zinc-500">{{ $escala->definicion_escala ?? 'Sin definición registrada.' }}</p>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="border-b border-zinc-100 p-6 dark:border-[#2b2b2b]">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Indicadores que usan esta escala</h3>
            </div>
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @forelse($escala->indicadoresLogro as $indicador)
                    <a href="{{ route('profesor.indicadores.show', $indicador->id_indicador) }}" wire:navigate class="flex items-center justify-between gap-4 p-5 transition hover:bg-[#fffaf0]">
                        <div>
                            <p class="font-medium text-zinc-800 dark:text-zinc-100">{{ $indicador->descripcion_logro }}</p>
                            <p class="mt-1 text-xs text-zinc-500">{{ $indicador->asignatura->nombre_asignatura ?? 'Sin asignatura' }}</p>
                        </div>
                        <flux:icon name="chevron-right" class="size-4 shrink-0 text-zinc-400" />
                    </a>
                @empty
                    <p class="p-6 text-center text-sm text-zinc-500">Ningún indicador usa esta escala todavía.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>
