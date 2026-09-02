@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Detalle del Acudiente</h2>
    <a href="{{ route('acudientes.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<div class="bg-white rounded-lg shadow p-6 space-y-4">
    <h3 class="text-xl font-bold text-indigo-700">{{ $acudiente->nombres_acudiente }} {{ $acudiente->apellidos_acudiente }}</h3>
    <p><strong>Documento:</strong> {{ $acudiente->tipo_documento }} {{ $acudiente->documento_identidad }}</p>
    <p><strong>Teléfono:</strong> {{ $acudiente->telefono_acudiente ?? 'N/A' }}</p>
    <p><strong>Parentesco:</strong> {{ $acudiente->parentesco ?? 'N/A' }}</p>
    <p><strong>Ocupación:</strong> {{ $acudiente->ocupacion ?? 'N/A' }}</p>
    <p><strong>Dirección:</strong> {{ $acudiente->direccion_residencia ?? 'N/A' }}</p>
</div>
@endsection