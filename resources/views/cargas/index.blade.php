@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Cargas Académicas / Asignaciones</h2>
        <p class="text-sm text-gray-600">Asignación de asignaturas y profesores por cada curso.</p>
    </div>
    <a href="{{ route('cargas.create', ) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Asignar Carga Académica
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Curso</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Asignatura</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Profesor Asignado</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Intensidad Horaria</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($cargas as $carga)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-800">{{ $carga->curso->nombre_curso ?? 'N/A' }}</td>
                <td class="p-4 font-medium text-gray-700">{{ $carga->asignatura->nombre_asignatura ?? 'N/A' }}</td>
                <td class="p-4">{{ $carga->profesor->nombres_profesor ?? 'N/A' }} {{ $carga->profesor->apellidos_profesor ?? '' }}</td>
                <td class="p-4">{{ $carga->intensidad_horaria ?? 'N/A' }} hrs/sem</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('cargas.edit', [$carga->id_carga ?? $carga->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('cargas.destroy', [$carga->id_carga ?? $carga->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta asignación?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">No hay cargas académicas asignadas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection