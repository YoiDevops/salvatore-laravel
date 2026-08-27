@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle de la Asignatura</h2>
    <a href="{{ route('asignaturas.index', request()->route('current_team')) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">Asignatura: {{ $asignatura->nombre_asignatura }}</h3>
    <p><strong>Área a la que pertenece:</strong> {{ $asignatura->area->nombre_area ?? 'N/A' }}</p>
</div>
@endsection