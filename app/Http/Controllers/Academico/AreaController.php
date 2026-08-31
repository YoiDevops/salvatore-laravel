<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Academico\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_area' => 'required|string|max:60|unique:area,nombre_area',
            'descripcion' => 'nullable|string',
        ]);

        Area::create($validated);

        return redirect()->route('areas.index')->with('success', 'Área creada correctamente.');
    }

    public function show(string $id)
    {
        $area = Area::with('asignaturas')->findOrFail($id);
        return view('areas.show', compact('area'));
    }

    public function edit(string $id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, string $id)
    {
        $area = Area::findOrFail($id);

        $validated = $request->validate([
            'nombre_area' => 'required|string|max:60|unique:area,nombre_area,' . $id . ',id_area',
            'descripcion' => 'nullable|string',
        ]);

        $area->update($validated);

        return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }
}
