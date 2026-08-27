@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Registrar Asignatura</h2>
    <a href="{{ route('asignaturas.index', request()->route('current_team')) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('asignaturas.store', request()->route('current_team')) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Asignatura *</label>
            <input type="text" name="nombre_asignatura" placeholder="Ej: Física, Química, Álgebra" required class="w-full border-gray-300 rounded-md border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Área Académica *</label>
            <select name="id_area" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                <option value="">Seleccione un área</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id_area }}">{{ $area->nombre_area }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('asignaturas.index', request()->route('current_team')) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Guardar Asignatura</button>
    </div>
</form>
@endsection