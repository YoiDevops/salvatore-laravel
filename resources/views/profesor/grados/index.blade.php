<x-layouts::app title="Grados">
    <div class="mx-auto max-w-5xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Panel docente</p>
                <flux:heading size="xl" class="mt-2">Grados</flux:heading>
                <flux:subheading class="mt-1">Niveles lectivos de la institución.</flux:subheading>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @forelse($grados as $grado)
                <a href="{{ route('profesor.grados.show', $grado->id_grado) }}" wire:navigate class="group rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <span class="flex size-11 items-center justify-center rounded-xl bg-[#f5eaf2] text-[#985278]"><flux:icon name="bookmark" class="size-5" /></span>
                        <flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" />
                    </div>
                    <h2 class="mt-5 font-semibold text-zinc-900 dark:text-zinc-100">{{ $grado->nombre_grado }}</h2>
                    <p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">{{ $grado->cursos_count }} {{ Str::plural('curso', $grado->cursos_count) }} asociados.</p>
                </a>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-zinc-200 bg-white p-10 text-center text-sm text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900">
                    No hay grados registrados todavía.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
