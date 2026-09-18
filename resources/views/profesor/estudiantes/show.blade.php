<x-layouts::app title="Detalle del estudiante">
    <div class="mx-auto max-w-3xl space-y-6">
        <a href="{{ route('profesor.estudiantes.index') }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver a estudiantes
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-[#2b2b2b] dark:bg-[#2b2b2b]">
            <div class="flex items-center gap-4">
                <span class="flex size-14 items-center justify-center rounded-2xl bg-[#e8f2e8] text-lg font-bold text-[#2f6f48]">
                    {{ Str::substr($estudiante->nombres_estudiante, 0, 1) }}{{ Str::substr($estudiante->apellidos_estudiante, 0, 1) }}
                </span>
                <div>
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">{{ $estudiante->nombres_estudiante }} {{ $estudiante->apellidos_estudiante }}</h2>
                    <p class="text-sm text-zinc-500">{{ $estudiante->tipo_documento }} {{ $estudiante->documento_identidad }}</p>
                </div>
                <span class="ml-auto rounded-full bg-[#e8f2e8] px-3 py-1 text-xs font-semibold text-[#2f6f48]">{{ $estudiante->estado_estudiante ?? 'Activo' }}</span>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach([
                    ['Curso', $estudiante->curso->nombre_curso ?? 'Sin curso'],
                    ['Grado', $estudiante->curso->grado->nombre_grado ?? 'N/D'],
                    ['Sede', $estudiante->curso->sede->nombre_sede ?? 'N/D'],
                    ['Género', $estudiante->genero ?? 'N/D'],
                    ['Fecha de nacimiento', $estudiante->fecha_nacimiento ?? 'N/D'],
                    ['Tipo de sangre', $estudiante->tipo_sangre ?? 'N/D'],
                    ['Lugar de nacimiento', $estudiante->lugar_nacimiento ?? 'N/D'],
                    ['EPS', $estudiante->eps ?? 'N/D'],
                ] as [$label, $value])
                    <div class="rounded-xl bg-[#f5f7fa] px-4 py-3 dark:bg-[#2b2b2b]">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-400">{{ $label }}</p>
                        <p class="mt-1 font-medium text-zinc-800 dark:text-zinc-100">{{ $value }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts::app>
