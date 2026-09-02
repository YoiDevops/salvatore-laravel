@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle del Profesor</h2>
    <a href="{{ route('profesores.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">{{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}</h3>
    <p><strong>Documento:</strong> {{ $profesor->tipo_documento }} {{ $profesor->documento_identidad }}</p>
    <p><strong>Especialidad:</strong> {{ $profesor->especialidad ?? 'N/A' }}</p>
    <p><strong>Teléfono:</strong> {{ $profesor->telefono_profesor ?? 'N/A' }}</p>
    <p><strong>Correo Electrónico:</strong> {{ $profesor->usuario->email ?? 'N/A' }}</p>
</div>
@endsection