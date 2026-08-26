<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::all();
        return view('instituciones.index', compact('instituciones'));
    }

    public function create()
    {
        return view('instituciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nit' => 'required|string|max:20|unique:institucion,nit',
            'nombre_institucion' => 'required|string|max:120',
            'direccion_principal' => 'required|string|max:150',
            'telefono_contacto' => 'nullable|string|max:20',
            'correo_electronico' => 'nullable|email|max:100',
            'registro_dane' => 'nullable|string|max:30|unique:institucion,registro_dane',
            'resolucion_aprobacion' => 'nullable|string|max:50',
            'url_logo' => 'nullable|string|max:255',
        ]);

        Institucion::create($validated);

        return redirect()->route('instituciones.index')->with('success', 'Institución creada correctamente.');
    }

    public function show(string $nit)
    {
        $institucion = Institucion::findOrFail($nit);
        return view('instituciones.show', compact('institucion'));
    }

    public function edit(string $nit)
    {
        $institucion = Institucion::findOrFail($nit);
        return view('instituciones.edit', compact('institucion'));
    }

    public function update(Request $request, string $nit)
    {
        $institucion = Institucion::findOrFail($nit);

        $validated = $request->validate([
            'nombre_institucion' => 'required|string|max:120',
            'direccion_principal' => 'required|string|max:150',
            'telefono_contacto' => 'nullable|string|max:20',
            'correo_electronico' => 'nullable|email|max:100',
            'registro_dane' => 'nullable|string|max:30|unique:institucion,registro_dane,' . $nit . ',nit',
            'resolucion_aprobacion' => 'nullable|string|max:50',
            'url_logo' => 'nullable|string|max:255',
        ]);

        $institucion->update($validated);

        return redirect()->route('instituciones.index')->with('success', 'Institución actualizada correctamente.');
    }

    public function destroy(string $nit)
    {
        $institucion = Institucion::findOrFail($nit);
        $institucion->delete();

        return redirect()->route('instituciones.index')->with('success', 'Institución eliminada correctamente.');
    }
}
