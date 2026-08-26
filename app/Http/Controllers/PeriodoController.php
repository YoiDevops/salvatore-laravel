<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::all();
        return view('periodos.index', compact('periodos'));
    }

    public function create()
    {
        return view('periodos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_periodo' => 'required|string|max:30',
            'porcentaje_periodo' => 'required|numeric|min:0|max:100',
            'anio_lectivo' => 'required|digits:4|integer',
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        Periodo::create($validated);

        return redirect()->route('periodos.index')->with('success', 'Periodo creado correctamente.');
    }

    public function show(string $id)
    {
        $periodo = Periodo::with('indicadoresLogro')->findOrFail($id);
        return view('periodos.show', compact('periodo'));
    }

    public function edit(string $id)
    {
        $periodo = Periodo::findOrFail($id);
        return view('periodos.edit', compact('periodo'));
    }

    public function update(Request $request, string $id)
    {
        $periodo = Periodo::findOrFail($id);

        $validated = $request->validate([
            'nombre_periodo' => 'required|string|max:30',
            'porcentaje_periodo' => 'required|numeric|min:0|max:100',
            'anio_lectivo' => 'required|digits:4|integer',
            'fecha_inicio' => 'required|date',
            'fecha_cierre' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $periodo->update($validated);

        return redirect()->route('periodos.index')->with('success', 'Periodo actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $periodo = Periodo::findOrFail($id);
        $periodo->delete();

        return redirect()->route('periodos.index')->with('success', 'Periodo eliminado correctamente.');
    }
}
