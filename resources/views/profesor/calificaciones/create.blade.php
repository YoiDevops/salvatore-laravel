<x-layouts::app title="Poner nota">
    <div class="mx-auto max-w-5xl space-y-6">
        <a href="{{ route('profesor.cursos.show', $curso->id_curso) }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-medium text-zinc-500 hover:text-[#9a761f]">
            <flux:icon name="arrow-left" class="size-4" /> Volver al curso
        </a>

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Curso {{ $curso->nombre_curso }}</p>
            <flux:heading size="xl" class="mt-2">Poner nota</flux:heading>
            <p class="mt-1 text-zinc-600 dark:text-zinc-300">{{ $estudiante->nombres_estudiante }} {{ $estudiante->apellidos_estudiante }}</p>
            <p class="mt-1 text-sm text-zinc-500">Selecciona un indicador agrupado por asignatura. El periodo corresponde al indicador.</p>
        </div>

        @if (session('success'))
            <div role="status" class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            @if ($notaMinima === null || $notaMaxima === null)
                <p class="text-sm text-red-600 dark:text-red-400">No hay una escala de valoración configurada. Solicita al administrador que la configure antes de registrar notas.</p>
            @elseif ($asignaturas->isEmpty())
                <p class="text-sm text-zinc-600 dark:text-zinc-300">No hay indicadores de logro asociados a asignaturas para calificar.</p>
            @else
                <form method="POST" action="{{ route('profesor.cursos.estudiantes.calificaciones.store', ['curso' => $curso->id_curso, 'estudiante' => $estudiante->id_estudiante]) }}" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label for="id_indicador" class="block text-sm font-semibold text-zinc-800 dark:text-zinc-200">Asignatura e indicador de logro</label>
                        @php($indicadorSeleccionado = old('id_indicador', $indicadorSeleccionado))
                        <select
                            id="id_indicador"
                            name="id_indicador"
                            required
                            data-calificacion-indicador
                            class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100"
                        >
                            <option value="">Selecciona un indicador</option>
                            @foreach ($asignaturas as $asignatura)
                                <optgroup label="{{ $asignatura->nombre_asignatura }}">
                                    @foreach ($asignatura->indicadoresLogro as $indicador)
                                        @php($calificacionExistente = $calificacionesPorIndicador->get($indicador->id_indicador))
                                        <option
                                            value="{{ $indicador->id_indicador }}"
                                            data-nota="{{ $calificacionExistente?->nota ?? '' }}"
                                            @selected((string) $indicadorSeleccionado === (string) $indicador->id_indicador)
                                        >
                                            {{ $indicador->codigo_logro ? $indicador->codigo_logro.' — ' : '' }}{{ $indicador->descripcion_logro }} ({{ $indicador->periodo->nombre_periodo ?? 'Sin periodo' }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('id_indicador')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="nota" class="block text-sm font-semibold text-zinc-800 dark:text-zinc-200">Nota</label>
                        <input
                            id="nota"
                            name="nota"
                            type="number"
                            min="{{ $notaMinima }}"
                            max="{{ $notaMaxima }}"
                            step="0.01"
                            value="{{ old('nota', $calificacionesPorIndicador->get($indicadorSeleccionado)?->nota) }}"
                            required
                            data-calificacion-nota
                            class="w-full rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100 sm:max-w-xs"
                        >
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            Rango permitido: {{ number_format((float) $notaMinima, 1) }} a {{ number_format((float) $notaMaxima, 1) }}.
                            Desempeño automático: Bajo (1.0–2.9), Básico (3.0–3.9), Alto (4.0–4.9) y Superior (5.0).
                        </p>
                        @error('nota')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <flux:button type="submit" class="crud-action-button">Guardar nota</flux:button>
                        <flux:button href="{{ route('profesor.cursos.show', $curso->id_curso) }}" variant="ghost" wire:navigate>Cancelar</flux:button>
                    </div>
                </form>
            @endif
        </div>

        <div class="rounded-2xl border border-[#d8dee8] bg-white shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-100 p-6 dark:border-zinc-800">
                <h2 class="font-semibold text-zinc-900 dark:text-zinc-100">Notas registradas</h2>
                <p class="mt-1 text-sm text-zinc-500">Puedes volver a calificar un indicador; se actualizará la nota existente.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/60">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Asignatura e indicador</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Periodo</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Nota</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wide text-zinc-500">Desempeño</th>
                            <th class="p-4 text-right text-xs font-semibold uppercase tracking-wide text-zinc-500">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($calificaciones as $calificacion)
                            <tr>
                                <td class="p-4">
                                    <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $calificacion->indicador->asignatura->nombre_asignatura ?? 'Asignatura no disponible' }}</p>
                                    <p class="mt-1 text-xs text-zinc-500">{{ $calificacion->indicador->codigo_logro }} — {{ $calificacion->indicador->descripcion_logro }}</p>
                                </td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $calificacion->indicador->periodo->nombre_periodo ?? 'N/D' }}</td>
                                <td class="p-4 font-semibold text-zinc-900 dark:text-zinc-100">{{ number_format((float) $calificacion->nota, 2) }}</td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-300">{{ $calificacion->escalaValoracion->nombre_desempeno === 'Basico' ? 'Básico' : $calificacion->escalaValoracion->nombre_desempeno }}</td>
                                <td class="p-4 text-right">
                                    <flux:button
                                        class="crud-action-button"
                                        size="sm"
                                        href="{{ route('profesor.cursos.estudiantes.calificaciones.create', ['curso' => $curso->id_curso, 'estudiante' => $estudiante->id_estudiante, 'indicador' => $calificacion->id_indicador]) }}"
                                        wire:navigate
                                    >Editar</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-sm text-zinc-500">Este estudiante todavía no tiene notas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const connectGradeInput = () => {
                const indicator = document.querySelector('[data-calificacion-indicador]');
                const grade = document.querySelector('[data-calificacion-nota]');

                if (!indicator || !grade || indicator.dataset.gradeInputConnected) {
                    return;
                }

                indicator.dataset.gradeInputConnected = 'true';
                indicator.addEventListener('change', () => {
                    grade.value = indicator.selectedOptions[0]?.dataset.nota ?? '';
                });
            };

            connectGradeInput();
            document.addEventListener('livewire:navigated', connectGradeInput);
        })();
    </script>
</x-layouts::app>
