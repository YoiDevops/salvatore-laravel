<x-layouts::app title="Escalas de valoración">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Escalas de valoración</flux:heading>
                <flux:subheading class="mt-1">Rangos de desempeño usados para evaluar a los estudiantes.</flux:subheading>
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-[#2b2b2b]">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Desempeño</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Nota mínima</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Nota máxima</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Definición</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @php($colores = ['Superior' => 'bg-[#e8f2e8] text-[#2f6f48]', 'Alto' => 'bg-[#edf1fa] text-[#526da8]', 'Basico' => 'bg-[#fbf1df] text-[#a46b21]', 'Bajo' => 'bg-[#fbe4e4] text-[#a13f3f]'])
                        @forelse($escalas as $escala)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/40">
                                <td class="p-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $colores[$escala->nombre_desempeno] ?? 'bg-zinc-100 text-zinc-600' }}">{{ $escala->nombre_desempeno }}</span>
                                </td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $escala->nota_minima }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $escala->nota_maxima }}</td>
                                <td class="p-4 max-w-sm truncate text-zinc-600 dark:text-zinc-300">{{ $escala->definicion_escala ?? 'Sin definición' }}</td>
                                <td class="p-4 text-right">
                                    <flux:button size="sm" href="{{ route('profesor.escalas.show', $escala->id_escala) }}" wire:navigate>Ver</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-zinc-500">No hay escalas de valoración registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
