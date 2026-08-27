@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Registrar Acudiente</h2>
    <a href="{{ route('acudientes.index', request()->route('current_team')) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('acudientes.store', request()->route('current_team')) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Documento *</label>
            <select name="tipo_documento" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="CC">CC</option>
                <option value="CE">CE</option>
                <option value="PASAPORTE">PASAPORTE</option>
                <option value="PPT">PPT</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Documento de Identidad *</label>
            <input type="text" name="documento_identidad" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
            <input type="text" name="nombres_acudiente" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos *</label>
            <input type="text" name="apellidos_acudiente" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="text" name="telefono_acudiente" class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Parentesco</label>
            <select name="parentesco" class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="Padre">Padre</option>
                <option value="Madre">Madre</option>
                <option value="Tío/a">Tío/a</option>
                <option value="Abuelo/a">Abuelo/a</option>
                <option value="Tutor Legal">Tutor Legal</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ocupación</label>
            <input type="text" name="ocupacion" class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dirección Residencia</label>
            <input type="text" name="direccion_residencia" class="w-full border-gray-300 rounded-md border p-2">
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('acudientes.index', request()->route('current_team')) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Guardar Acudiente</button>
    </div>
</form>
@endsection