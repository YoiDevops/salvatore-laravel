@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle de la Carga Académica</h2>
    <a href="{{ route('cargas.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">Curso: {{ $carga->curso->nombre_curso ?? 'N/A' }}</h3>
    <p><strong>Asignatura:</strong> {{ $carga->asignatura->nombre_asignatura ?? 'N/A' }}</p>
    <p><strong>Profesor Responsable:</strong> {{ $carga->profesor->nombres_profesor ?? 'N/A' }} {{ $carga->profesor->apellidos_profesor ?? '' }}</p>
    <p><strong>Intensidad Horaria:</strong> {{ $carga->intensidad_horaria ?? 'N/A' }} Horas/Semana</p>
</div>
@endsection