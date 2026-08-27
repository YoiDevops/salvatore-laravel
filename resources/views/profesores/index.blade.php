@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Listado de Profesores</h2>
        <p class="text-sm text-gray-600">Administra los docentes de la institución.</p>
    </div>
    <a href="{{ route('profesores.create', request()->route('current_team')) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Registrar Profesor
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Documento</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nombre Completo</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Especialidad</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Teléfono</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($profesores as $profesor)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-medium text-gray-900">
                    <span class="text-xs font-bold text-gray-500 uppercase">{{ $profesor->tipo_documento }}:</span> 
                    {{ $profesor->documento_identidad }}
                </td>
                <td class="p-4">{{ $profesor->nombres_profesor }} {{ $profesor->apellidos_profesor }}</td>
                <td class="p-4">{{ $profesor->especialidad ?? 'General' }}</td>
                <td class="p-4">{{ $profesor->telefono_profesor ?? 'N/A' }}</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('profesores.show', [request()->route('current_team'), $profesor->id_profesor ?? $profesor->id]) }}" class="text-blue-600 hover:text-blue-900 font-medium">Ver</a>
                    <a href="{{ route('profesores.edit', [request()->route('current_team'), $profesor->id_profesor ?? $profesor->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('profesores.destroy', [request()->route('current_team'), $profesor->id_profesor ?? $profesor->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este profesor?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-500">No hay profesores registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection