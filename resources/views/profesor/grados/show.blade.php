<x-layouts::app title="Detalle del grado">
    <div class="mx-auto max-w-4xl space-y-6">
        <a href="{{ route('profesor.grados.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a grados
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="flex items-center gap-4">
                <span class="flex size-14 items-center justify-center rounded-2xl bg-[#f5eaf2] text-[#985278]"><flux:icon name="bookmark" class="size-6" /></span>
                <div>
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">{{ $grado->nombre_grado }}</h2>
                    <p class="text-sm text-zinc-500">{{ $grado->cursos->count() }} {{ Str::plural('curso', $grado->cursos->count()) }} asociados</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="border-b border-zinc-100 p-6 dark:border-[#2b2b2b]">
                <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">Cursos de este grado</h3>
                <p class="mt-1 text-sm text-zinc-500">Grupos activos que pertenecen a este nivel.</p>
            </div>
            <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                @forelse($grado->cursos as $curso)
                    <a href="{{ route('profesor.cursos.show', $curso->id_curso) }}" wire:navigate class="flex items-center justify-between gap-4 p-5 transition hover:bg-[#fffaf0]">
                        <div>
                            <p class="font-medium text-zinc-800 dark:text-zinc-100">{{ $curso->nombre_curso }}</p>
                            <p class="mt-1 text-xs text-zinc-500">{{ $curso->jornada ?? 'Jornada N/D' }} &middot; {{ $curso->estudiantes()->count() }} estudiantes</p>
                        </div>
                        <flux:icon name="chevron-right" class="size-4 shrink-0 text-zinc-400" />
                    </a>
                @empty
                    <p class="p-6 text-center text-sm text-zinc-500">Este grado aún no tiene cursos asociados.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>
