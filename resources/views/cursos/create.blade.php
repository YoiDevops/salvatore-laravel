@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Registrar Nuevo Curso</h2>
    <a href="{{ route('cursos.index', request()->route('current_team')) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('cursos.store', request()->route('current_team')) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Curso *</label>
            <input type="text" name="nombre_curso" placeholder="Ej: 1001, 6A..." required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Grado *</label>
            <select name="id_grado" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="">Seleccione un grado</option>
                @foreach($grados as $grado)
                    <option value="{{ $grado->id_grado }}">{{ $grado->nombre_grado }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Director de Grupo (Opcional)</label>
            <select name="id_profesor_director" class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="">Ninguno</option>
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->id_profesor }}">{{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('cursos.index', request()->route('current_team')) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Guardar Curso</button>
    </div>
</form>
@endsection