<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Academico\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::all();
        return view('grados.index', compact('grados'));
    }

    public function create()
    {
        return view('grados.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_grado' => 'required|string|max:25',
            'edad_minima' => 'nullable|integer|min:0|max:255',
            'edad_maxima' => 'nullable|integer|min:0|max:255',
            'ano_lectivo' => 'nullable|string|max:20', // <-- Agregado
        ]);

        Grado::create($validated);

        return redirect()->route('grados.index')->with('success', 'Grado creado correctamente.');
    }

    public function show(string $id)
    {
        $grado = Grado::with('cursos')->findOrFail($id);
        return view('grados.show', compact('grado'));
    }

    public function edit(string $id)
    {
        $grado = Grado::findOrFail($id);
        return view('grados.edit', compact('grado'));
    }

    public function update(Request $request, string $id)
    {
        $grado = Grado::findOrFail($id);

        $validated = $request->validate([
            'nombre_grado' => 'required|string|max:25',
        ]);

        $grado->update($validated);

        return redirect()->route('grados.index')->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();

        return redirect()->route('grados.index')->with('success', 'Grado eliminado correctamente.');
    }
}