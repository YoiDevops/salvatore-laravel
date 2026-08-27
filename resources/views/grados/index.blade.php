@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Grados Académicos</h2>
        <p class="text-sm text-gray-600">Configuración de niveles lectivos o grados.</p>
    </div>
    <a href="{{ route('grados.create', request()->route('current_team')) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Registrar Grado
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nombre del Grado</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nivel Educativo</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($grados as $grado)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-800">{{ $grado->nombre_grado }}</td>
                <td class="p-4">{{ $grado->nivel_educativo ?? 'General' }}</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('grados.edit', [request()->route('current_team'), $grado->id_grado ?? $grado->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('grados.destroy', [request()->route('current_team'), $grado->id_grado ?? $grado->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este grado?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-6 text-center text-gray-500">No hay grados registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection