<form method="POST" action="{{ isset($carga) ? route('cargas.update', $carga) : route('cargas.store') }}" class="space-y-6">
    @csrf
    @if (isset($carga))
        @method('PUT')
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="id_curso" class="mb-1.5 block text-sm font-medium text-zinc-800 dark:text-zinc-200">Curso <span aria-hidden="true">*</span></label>
            <select id="id_curso" name="id_curso" required class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                <option value="">Selecciona un curso</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id_curso }}" @selected((string) old('id_curso', $carga->id_curso ?? '') === (string) $curso->id_curso)>
                        {{ $curso->nombre_curso }}{{ $curso->grado ? ' · '.$curso->grado->nombre_grado : '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_asignatura" class="mb-1.5 block text-sm font-medium text-zinc-800 dark:text-zinc-200">Asignatura <span aria-hidden="true">*</span></label>
            <select id="id_asignatura" name="id_asignatura" required class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                <option value="">Selecciona una asignatura</option>
                @foreach ($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id_asignatura }}" @selected((string) old('id_asignatura', $carga->id_asignatura ?? '') === (string) $asignatura->id_asignatura)>
                        {{ $asignatura->nombre_asignatura }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_profesor" class="mb-1.5 block text-sm font-medium text-zinc-800 dark:text-zinc-200">Profesor asignado <span aria-hidden="true">*</span></label>
            <select id="id_profesor" name="id_profesor" required class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                <option value="">Selecciona un profesor</option>
                @foreach ($profesores as $profesor)
                    <option value="{{ $profesor->id_profesor }}" @selected((string) old('id_profesor', $carga->id_profesor ?? '') === (string) $profesor->id_profesor)>
                        {{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="intensidad_horaria" class="mb-1.5 block text-sm font-medium text-zinc-800 dark:text-zinc-200">Horas semanales</label>
            <input id="intensidad_horaria" name="intensidad_horaria" type="number" min="1" max="255" value="{{ old('intensidad_horaria', $carga->intensidad_horaria ?? '') }}" aria-describedby="intensidad-ayuda" class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
            <p id="intensidad-ayuda" class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400">Indica cuántas horas por semana se dedica a esta asignatura, si ya está definido.</p>
        </div>
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
        <a href="{{ route('cargas.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Cancelar</a>
        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-[#c49a35] px-4 py-2.5 text-sm font-semibold text-zinc-950 transition hover:bg-[#d3ad50]">
            {{ isset($carga) ? 'Guardar cambios' : 'Guardar asignación' }}
        </button>
    </div>
</form>
