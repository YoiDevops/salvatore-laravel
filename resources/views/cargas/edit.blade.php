@extends('layouts.academico')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Editar Carga Académica</h2>
    <a href="{{ route('cargas.index', ) }}" class="text-gray-600 hover:text-gray-900">← Volver</a>
</div>

<form action="{{ route('cargas.update', [$carga->id_carga ?? $carga->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Curso *</label>
            <select name="id_curso" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}" {{ old('id_curso', $carga->id_curso) == $curso->id_curso ? 'selected' : '' }}>
                        {{ $curso->nombre_curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Asignatura *</label>
            <select name="id_asignatura" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id_asignatura }}" {{ old('id_asignatura', $carga->id_asignatura) == $asignatura->id_asignatura ? 'selected' : '' }}>
                        {{ $asignatura->nombre_asignatura }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Profesor Asignado *</label>
            <select name="id_profesor" required class="w-full border-gray-300 rounded-md border p-2 bg-white">
                @foreach($profesores as $profesor)
                    <option value="{{ $profesor->id_profesor }}" {{ old('id_profesor', $carga->id_profesor) == $profesor->id_profesor ? 'selected' : '' }}>
                        {{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Intensidad Horaria Semanal (Horas)</label>
            <input type="number" name="intensidad_horaria" value="{{ old('intensidad_horaria', $carga->intensidad_horaria) }}" min="1" class="w-full border-gray-300 rounded-md border p-2">
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('cargas.index', ) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Actualizar Carga</button>
    </div>
</form>
@endsection