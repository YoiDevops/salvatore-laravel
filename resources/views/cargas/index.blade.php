@extends('layouts.academico')

@section('content')
    <div class="mx-auto max-w-[96rem] space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión institucional</p>
                <h1 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Cargas académicas</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Consulta y asigna profesores a las materias de cada curso.</p>
            </div>
            <a href="{{ route('cargas.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#c49a35] px-4 py-2.5 text-sm font-semibold text-zinc-950 transition hover:bg-[#d3ad50]">Nueva asignación</a>
        </div>

        <section class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
            <form method="GET" action="{{ route('cargas.index') }}" class="flex flex-col gap-3 sm:flex-row">
                <label for="search-cargas" class="sr-only">Buscar curso, asignatura o profesor</label>
                <input id="search-cargas" type="search" name="search" value="{{ request('search') }}" placeholder="Buscar curso, asignatura o profesor" class="min-w-0 flex-1 rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-[#c49a35] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/30 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                <button type="submit" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Buscar</button>
                @if (request()->filled('search'))
                    <a href="{{ route('cargas.index') }}" class="rounded-lg px-4 py-2.5 text-center text-sm font-semibold text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">Limpiar</a>
                @endif
            </form>

            <p class="mt-3 text-xs text-zinc-500 lg:hidden dark:text-zinc-400">Desliza la tabla hacia los lados para revisar todas las columnas.</p>
            <div class="mt-4 overflow-x-auto" role="region" aria-label="Cargas académicas; desliza horizontalmente para ver más" tabindex="0">
                <table class="w-full min-w-[760px] text-left text-sm">
                    <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500 dark:border-zinc-800">
                        <tr>
                            <th class="p-3">Curso</th>
                            <th class="p-3">Asignatura</th>
                            <th class="p-3">Profesor</th>
                            <th class="p-3">Horas semanales</th>
                            <th class="p-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cargas as $carga)
                            <tr class="border-b border-zinc-100 transition hover:bg-zinc-50 dark:border-zinc-800 dark:hover:bg-zinc-800/60">
                                <td class="p-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $carga->curso->nombre_curso }}{{ $carga->curso->grado ? ' · '.$carga->curso->grado->nombre_grado : '' }}</td>
                                <td class="p-3 text-zinc-700 dark:text-zinc-300">{{ $carga->asignatura->nombre_asignatura }}</td>
                                <td class="p-3 text-zinc-700 dark:text-zinc-300">{{ $carga->profesor->nombres_profesor }} {{ $carga->profesor->apellidos_profesor }}</td>
                                <td class="p-3 text-zinc-700 dark:text-zinc-300">{{ $carga->intensidad_horaria ? $carga->intensidad_horaria.' h' : 'Pendiente' }}</td>
                                <td class="p-3">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a href="{{ route('cargas.show', $carga) }}" class="rounded-lg border border-zinc-300 px-3 py-2 text-xs font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Ver</a>
                                        <a href="{{ route('cargas.edit', $carga) }}" class="rounded-lg border border-zinc-300 px-3 py-2 text-xs font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Editar</a>
                                        <form method="POST" action="{{ route('cargas.destroy', $carga) }}" data-confirm-title="Eliminar asignación" data-confirm-message="Se eliminará la asignación de {{ $carga->asignatura->nombre_asignatura }} al curso {{ $carga->curso->nombre_curso }} y al profesor {{ $carga->profesor->nombres_profesor }} {{ $carga->profesor->apellidos_profesor }}." data-confirm-label="Eliminar" data-confirm-tone="danger">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-700">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-zinc-500 dark:text-zinc-400">No hay asignaciones académicas para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $cargas->links() }}</div>
        </section>
    </div>
@endsection