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
                <label class="block text-sm font-medium text-gray-700 mb-1">Sede *</label>
                <select name="id_sede" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                    @foreach($sedes as $sede)
                        <option value="{{ $sede->id_sede }}" {{ old('id_sede', $curso->id_sede) == $sede->id_sede ? 'selected' : '' }}>{{ $sede->nombre_sede }}</option>
                    @endforeach
                </select>
        </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cupo máximo *</label>
                <input type="number" name="cupo_maximo" min="1" value="{{ old('cupo_maximo', $curso->cupo_maximo) }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jornada</label>
                <input type="text" name="jornada" value="{{ old('jornada', $curso->jornada) }}" class="w-full border-gray-300 rounded-md border p-2">
            </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('cursos.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Actualizar Curso</button>
    </div>
</form>
@endsection