@extends('layouts.academico')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Periodos Académicos</h2>
        <p class="text-sm text-gray-600">Gestión de lapsos o lapsos evaluativos (ej: Primer Periodo, Q1).</p>
    </div>
    <a href="{{ route('periodos.create', request()->route('current_team')) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
        + Registrar Periodo
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Nombre del Periodo</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Porcentaje</th>
                <th class="p-4 text-xs font-semibold text-gray-600 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-sm">
            @forelse($periodos as $periodo)
            <tr class="hover:bg-gray-50">
                <td class="p-4 font-bold text-gray-800">{{ $periodo->nombre_periodo }}</td>
                <td class="p-4 font-semibold text-indigo-600">{{ $periodo->porcentaje ?? 25 }}%</td>
                <td class="p-4 space-x-2 flex items-center">
                    <a href="{{ route('periodos.edit', [request()->route('current_team'), $periodo->id_periodo ?? $periodo->id]) }}" class="text-yellow-600 hover:text-yellow-900 font-medium">Editar</a>
                    <form action="{{ route('periodos.destroy', [request()->route('current_team'), $periodo->id_periodo ?? $periodo->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este periodo?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-6 text-center text-gray-500">No hay periodos registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection