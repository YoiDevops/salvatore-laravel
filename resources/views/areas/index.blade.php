@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Áreas Académicas</h2>
        <p class="text-sm text-gray-600">Gestión de áreas de conocimiento institucionales.</p>
    </div>
    <a href="{{ route('areas.create', ) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Registrar Área
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nombre del Área</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Descripción</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($areas as $area)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-800">{{ $area->nombre_area }}</td>
                <td class="p-4 text-gray-600">{{ $area->descripcion ?? 'Sin descripción' }}</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('areas.edit', [$area->id_area ?? $area->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('areas.destroy', [$area->id_area ?? $area->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta área?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-6 text-center text-gray-500">No hay áreas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection