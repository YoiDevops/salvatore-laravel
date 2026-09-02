@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle del Curso</h2>
    <a href="{{ route('cursos.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">Curso: {{ $curso->nombre_curso }}</h3>
    <p><strong>Grado al que pertenece:</strong> {{ $curso->grado->nombre_grado ?? 'N/A' }}</p>
    <p><strong>Director de Grupo:</strong> {{ $curso->profesorDirector->nombres_profesor ?? 'Sin asignar' }} {{ $curso->profesorDirector->apellidos_profesor ?? '' }}</p>
</div>
@endsection