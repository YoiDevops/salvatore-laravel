@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle del Grado</h2>
    <a href="{{ route('grados.index', request()->route('current_team')) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">Grado: {{ $grado->nombre_grado }}</h3>
    <p><strong>Nivel Educativo:</strong> {{ $grado->nivel_educativo ?? 'N/A' }}</p>
</div>
@endsection