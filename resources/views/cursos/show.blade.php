@extends('layouts.academico')

@section('content')
<div class="mb-6 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
    <h2 class="break-words text-xl font-bold text-gray-800 sm:text-2xl">Detalle del Curso</h2>
    <a href="{{ route('cursos.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="min-w-0 space-y-4 rounded-lg bg-white p-4 shadow sm:p-6">
    <h3 class="text-xl font-bold text-indigo-700">Curso: {{ $curso->nombre_curso }}</h3>
    <p><strong>Grado al que pertenece:</strong> {{ $curso->grado->nombre_grado ?? 'N/A' }}</p>
    <p><strong>Sede:</strong> {{ $curso->sede->nombre_sede ?? 'N/A' }}</p>
</div>
@endsection