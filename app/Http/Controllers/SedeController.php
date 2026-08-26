<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Institucion;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index()
    {
        $sedes = Sede::with('institucion')->get();
        return view('sedes.index', compact('sedes'));
    }

    public function create()
    {
        $instituciones = Institucion::all();
        return view('sedes.create', compact('instituciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nit' => 'required|string|exists:institucion,nit',
            'nombre_sede' => 'required|string|max:80',
            'direccion_sede' => 'nullable|string|max:150',
            'telefono_sede' => 'nullable|string|max:20',
        ]);

        Sede::create($validated);

        return redirect()->route('sedes.index')->with('success', 'Sede creada correctamente.');
    }

    public function show(string $id)
    {
        $sede = Sede::with('institucion', 'cursos')->findOrFail($id);
        return view('sedes.show', compact('sede'));
    }

    public function edit(string $id)
    {
        $sede = Sede::findOrFail($id);
        $instituciones = Institucion::all();
        return view('sedes.edit', compact('sede', 'instituciones'));
    }

    public function update(Request $request, string $id)
    {
        $sede = Sede::findOrFail($id);

        $validated = $request->validate([
            'nit' => 'required|string|exists:institucion,nit',
            'nombre_sede' => 'required|string|max:80',
            'direccion_sede' => 'nullable|string|max:150',
            'telefono_sede' => 'nullable|string|max:20',
        ]);

        $sede->update($validated);

        return redirect()->route('sedes.index')->with('success', 'Sede actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $sede = Sede::findOrFail($id);
        $sede->delete();

        return redirect()->route('sedes.index')->with('success', 'Sede eliminada correctamente.');
    }
}
