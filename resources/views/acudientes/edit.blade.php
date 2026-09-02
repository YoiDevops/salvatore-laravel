@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Editar Acudiente</h2>
    <a href="{{ route('acudientes.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('acudientes.update', [$acudiente->id_acudiente ?? $acudiente->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Documento *</label>
            <select name="tipo_documento" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach(['CC', 'CE', 'PASAPORTE', 'PPT'] as $tipo)
                    <option value="{{ $tipo }}" {{ old('tipo_documento', $acudiente->tipo_documento) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Documento de Identidad *</label>
            <input type="text" name="documento_identidad" value="{{ old('documento_identidad', $acudiente->documento_identidad) }}" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
            <input type="text" name="nombres_acudiente" value="{{ old('nombres_acudiente', $acudiente->nombres_acudiente) }}" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos *</label>
            <input type="text" name="apellidos_acudiente" value="{{ old('apellidos_acudiente', $acudiente->apellidos_acudiente) }}" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="text" name="telefono_acudiente" value="{{ old('telefono_acudiente', $acudiente->telefono_acudiente) }}" class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Parentesco</label>
            <select name="parentesco" class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach(['Padre', 'Madre', 'Tío/a', 'Abuelo/a', 'Tutor Legal', 'Otro'] as $par)
                    <option value="{{ $par }}" {{ old('parentesco', $acudiente->parentesco) == $par ? 'selected' : '' }}>{{ $par }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ocupación</label>
            <input type="text" name="ocupacion" value="{{ old('ocupacion', $acudiente->ocupacion) }}" class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dirección Residencia</label>
            <input type="text" name="direccion_residencia" value="{{ old('direccion_residencia', $acudiente->direccion_residencia) }}" class="w-full border-gray-300 rounded-md border p-2">
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('acudientes.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Actualizar Acudiente</button>
    </div>
</form>
@endsection