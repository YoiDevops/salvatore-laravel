<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Sede;
use App\Models\Grado;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('sede', 'grado')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $grados = Grado::all();
        return view('cursos.create', compact('sedes', 'grados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_sede' => 'required|integer|exists:sede,id_sede',
            'id_grado' => 'required|integer|exists:grado,id_grado',
            'nombre_curso' => 'required|string|max:15',
            'cupo_maximo' => 'required|string|max:10',
            'jornada' => 'nullable|string|max:10',
        ]);

        Curso::create($validated);

        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    public function show(string $id)
    {
        $curso = Curso::with('sede', 'grado', 'estudiantes')->findOrFail($id);
        return view('cursos.show', compact('curso'));
    }

    public function edit(string $id)
    {
        $curso = Curso::findOrFail($id);
        $sedes = Sede::all();
        $grados = Grado::all();
        return view('cursos.edit', compact('curso', 'sedes', 'grados'));
    }

    public function update(Request $request, string $id)
    {
        $curso = Curso::findOrFail($id);

        $validated = $request->validate([
            'id_sede' => 'required|integer|exists:sede,id_sede',
            'id_grado' => 'required|integer|exists:grado,id_grado',
            'nombre_curso' => 'required|string|max:15',
            'cupo_maximo' => 'required|string|max:10',
            'jornada' => 'nullable|string|max:10',
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso eliminado correctamente.');
    }
}
