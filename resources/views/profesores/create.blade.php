@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Registrar Profesor</h2>
    <a href="{{ route('profesores.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('profesores.store', ) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    
    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">1. Credenciales de Usuario</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de Usuario *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña *</label>
                <input type="password" name="password" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">2. Datos del Profesor</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Documento *</label>
                <select name="tipo_documento" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                    <option value="CC">CC</option>
                    <option value="CE">CE</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Documento de Identidad *</label>
                <input type="text" name="documento_identidad" value="{{ old('documento_identidad') }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombres *</label>
                <input type="text" name="nombres_profesor" value="{{ old('nombres_profesor') }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Apellidos *</label>
                <input type="text" name="apellidos_profesor" value="{{ old('apellidos_profesor') }}" required class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                <input type="text" name="especialidad" value="{{ old('especialidad') }}" class="w-full border-gray-300 rounded-md border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                <input type="text" name="telefono_profesor" value="{{ old('telefono_profesor') }}" class="w-full border-gray-300 rounded-md border p-2">
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('profesores.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Guardar Profesor</button>
    </div>
</form>
@endsection