@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Editar Curso</h2>
    <a href="{{ route('cursos.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('cursos.update', [$curso->id_curso ?? $curso->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Curso *</label>
            <input type="text" name="nombre_curso" value="{{ old('nombre_curso', $curso->nombre_curso) }}" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Grado *</label>
            <select name="id_grado" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach($grados as $grado)
                    <option value="{{ $grado->id_grado }}" {{ old('id_grado', $curso->id_grado) == $grado->id_grado ? 'selected' : '' }}>
                        {{ $grado->nombre_grado }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Director de Grupo</label>
            <select name="id_profesor_director" class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="">Ninguno</option>
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->id_profesor }}" {{ old('id_profesor_director', $curso->id_profesor_director) == $profesor->id_profesor ? 'selected' : '' }}>
                        {{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('cursos.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Actualizar Curso</button>
    </div>
</form>
@endsection