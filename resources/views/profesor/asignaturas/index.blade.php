@php($gradientes = [
    'from-[#e2c66f] to-[#c49a35]',
    'from-[#a9b8e8] to-[#526da8]',
    'from-[#7fc4e0] to-[#2f7fa0]',
    'from-[#9fd4b0] to-[#2f6f48]',
    'from-[#e3aacb] to-[#985278]',
])

<x-layouts::app title="Asignaturas">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Asignaturas</flux:heading>
                <flux:subheading class="mt-1">Vista general de las asignaturas por área académica.</flux:subheading>
            </div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]">
                <span class="size-2 rounded-full bg-[#c49a35]"></span> {{ $asignaturas->count() }} {{ Str::plural('asignatura', $asignaturas->count()) }}
            </div>
        </div>

        @include('components.search-filters', [
            'placeholder' => 'Asignatura, área o descripción...',
            'filterFields' => [['name' => 'area', 'label' => 'Área', 'options' => $areas->pluck('nombre_area', 'id_area')->all()]],
        ])

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @forelse($asignaturas as $asignatura)
                <a href="{{ route('profesor.asignaturas.show', $asignatura->id_asignatura) }}" wire:navigate class="group overflow-hidden rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="relative h-24 bg-gradient-to-br {{ $gradientes[$loop->index % count($gradientes)] }}">
                        <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(circle at 20% 30%, rgba(255,255,255,.5) 0, transparent 40%), radial-gradient(circle at 80% 70%, rgba(255,255,255,.35) 0, transparent 45%);"></div>
                        <span class="absolute right-3 top-3 rounded-full bg-white/85 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-zinc-700">{{ $asignatura->intensidad_horaria }}h</span>
                    </div>
                    <div class="p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">{{ $asignatura->area->nombre_area ?? 'Sin área' }}</p>
                        <h3 class="mt-1 font-bold text-zinc-900 dark:text-zinc-100">{{ $asignatura->nombre_asignatura }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $asignatura->descripcion ?? 'Sin descripción registrada.' }}</p>
                        <div class="mt-4 flex items-center justify-between border-t border-zinc-100 pt-3 text-sm dark:border-zinc-800">
                            <span class="flex items-center gap-1 text-zinc-500"><flux:icon name="clipboard-document-list" class="size-4" /> {{ $asignatura->indicadoresLogro->count() }} indicadores</span>
                            <flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" />
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-zinc-200 bg-white p-10 text-center text-sm text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900">
                    No hay asignaturas registradas todavía.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
