<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Area;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::with('area')->get();
        return view('asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('asignaturas.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_area' => 'required|integer|exists:area,id_area',
            'nombre_asignatura' => 'required|string|max:80',
            'intensidad_horaria' => 'required|integer|min:0|max:255',
            'porcentaje_area' => 'nullable|numeric|min:0|max:100',
            'descripcion' => 'nullable|string',
        ]);

        Asignatura::create($validated);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada correctamente.');
    }

    public function show(string $id)
    {
        $asignatura = Asignatura::with('area', 'indicadoresLogro')->findOrFail($id);
        return view('asignaturas.show', compact('asignatura'));
    }

    public function edit(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $areas = Area::all();
        return view('asignaturas.edit', compact('asignatura', 'areas'));
    }

    public function update(Request $request, string $id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $validated = $request->validate([
            'id_area' => 'required|integer|exists:area,id_area',
            'nombre_asignatura' => 'required|string|max:80',
            'intensidad_horaria' => 'required|integer|min:0|max:255',
            'porcentaje_area' => 'nullable|numeric|min:0|max:100',
            'descripcion' => 'nullable|string',
        ]);

        $asignatura->update($validated);

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada correctamente.');
    }
}
