@extends('layouts.academico')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión institucional</p>
            <h1 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Editar carga académica</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Actualiza el curso, la asignatura o el profesor responsable.</p>
        </div>

        <section class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900 sm:p-7">
            @include('cargas._form')
        </section>
    </div>
@endsection