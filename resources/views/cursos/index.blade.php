@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Listado de Cursos</h2>
        <p class="text-sm text-gray-600">Gestión de cursos y grupos institucionales.</p>
    </div>
    <a href="{{ route('cursos.create', request()->route('current_team')) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Registrar Curso
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nombre del Curso</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Grado</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Director de Grupo</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($cursos as $curso)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-800">{{ $curso->nombre_curso }}</td>
                <td class="p-4">{{ $curso->grado->nombre_grado ?? 'N/A' }}</td>
                <td class="p-4">{{ $curso->profesorDirector->nombres_profesor ?? 'Sin asignar' }} {{ $curso->profesorDirector->apellidos_profesor ?? '' }}</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('cursos.show', [request()->route('current_team'), $curso->id_curso ?? $curso->id]) }}" class="text-blue-600 hover:text-blue-900 font-medium">Ver</a>
                    <a href="{{ route('cursos.edit', [request()->route('current_team'), $curso->id_curso ?? $curso->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('cursos.destroy', [request()->route('current_team'), $curso->id_curso ?? $curso->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este curso?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-6 text-center text-gray-500">No hay cursos creados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection