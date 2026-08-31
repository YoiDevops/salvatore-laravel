<?php

namespace App\Http\Controllers\estudiante;

use App\Http\Controllers\Controller;
use App\Models\Estudiante\CaracterizacionDiscapacidad;
use Illuminate\Http\Request;

class CaracterizacionDiscapacidadController extends Controller
{
    public function index()
    {
        $caracterizaciones = CaracterizacionDiscapacidad::all();
        return view('caracterizaciones.index', compact('caracterizaciones'));
    }

    public function create()
    {
        return view('caracterizaciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_discapacidad' => 'required|string|max:60',
            'diagnostico' => 'nullable|string',
            'grado_discapacidad' => 'required|in:Leve,Moderada,Severa',
            'permanencia' => 'required|in:Temporal,Permanente',
            'grado_atencion' => 'nullable|string|max:80',
        ]);

        CaracterizacionDiscapacidad::create($validated);

        return redirect()->route('caracterizaciones.index')->with('success', 'Caracterización creada correctamente.');
    }

    public function show(string $id)
    {
        $caracterizacion = CaracterizacionDiscapacidad::with('estudiantes')->findOrFail($id);
        return view('caracterizaciones.show', compact('caracterizacion'));
    }

    public function edit(string $id)
    {
        $caracterizacion = CaracterizacionDiscapacidad::findOrFail($id);
        return view('caracterizaciones.edit', compact('caracterizacion'));
    }

    public function update(Request $request, string $id)
    {
        $caracterizacion = CaracterizacionDiscapacidad::findOrFail($id);

        $validated = $request->validate([
            'tipo_discapacidad' => 'required|string|max:60',
            'diagnostico' => 'nullable|string',
            'grado_discapacidad' => 'required|in:Leve,Moderada,Severa',
            'permanencia' => 'required|in:Temporal,Permanente',
            'grado_atencion' => 'nullable|string|max:80',
        ]);

        $caracterizacion->update($validated);

        return redirect()->route('caracterizaciones.index')->with('success', 'Caracterización actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $caracterizacion = CaracterizacionDiscapacidad::findOrFail($id);
        $caracterizacion->delete();

        return redirect()->route('caracterizaciones.index')->with('success', 'Caracterización eliminada correctamente.');
    }
}
