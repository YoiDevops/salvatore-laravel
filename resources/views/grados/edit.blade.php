@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Editar Grado</h2>
    <a href="{{ route('grados.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('grados.update', [$grado->id_grado ?? $grado->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Grado *</label>
            <input type="text" name="nombre_grado" value="{{ old('nombre_grado', $grado->nombre_grado) }}" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Educativo</label>
            <select name="nivel_educativo" class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach(['Preescolar', 'Primaria', 'Secundaria', 'Media'] as $nivel)
                    <option value="{{ $nivel }}" {{ old('nivel_educativo', $grado->nivel_educativo) == $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('grados.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Actualizar Grado</button>
    </div>
</form>
@endsection