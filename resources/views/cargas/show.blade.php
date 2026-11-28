@extends('layouts.academico')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión institucional</p>
                <h1 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Detalle de carga académica</h1>
            </div>
            <a href="{{ route('cargas.index') }}" class="text-sm font-semibold text-zinc-600 transition hover:text-[#9a761f] dark:text-zinc-300">Volver a las asignaciones</a>
        </div>

        <section class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900 sm:p-7">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500">Curso</dt>
                    <dd class="mt-1 text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $carga->curso->nombre_curso }}{{ $carga->curso->grado ? ' · '.$carga->curso->grado->nombre_grado : '' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500">Asignatura</dt>
                    <dd class="mt-1 text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $carga->asignatura->nombre_asignatura }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500">Profesor responsable</dt>
                    <dd class="mt-1 text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $carga->profesor->nombres_profesor }} {{ $carga->profesor->apellidos_profesor }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-zinc-500">Horas semanales</dt>
                    <dd class="mt-1 text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $carga->intensidad_horaria ? $carga->intensidad_horaria.' horas' : 'Pendiente de definir' }}</dd>
                </div>
            </dl>

            <div class="mt-7 flex flex-col-reverse gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
                <a href="{{ route('cargas.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-center text-sm font-semibold text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">Volver</a>
                <a href="{{ route('cargas.edit', $carga) }}" class="rounded-lg bg-[#c49a35] px-4 py-2.5 text-center text-sm font-semibold text-zinc-950 transition hover:bg-[#d3ad50]">Editar asignación</a>
            </div>
        </section>
    </div>
@endsection