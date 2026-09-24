<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Institucional\Sede;
use App\Models\Profesor\Profesor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $query = Curso::with('sede', 'grado');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_curso', 'like', "%{$search}%")
                    ->orWhere('jornada', 'like', "%{$search}%")
                    ->orWhereHas('grado', fn ($query) => $query->where('nombre_grado', 'like', "%{$search}%"))
                    ->orWhereHas('sede', fn ($query) => $query->where('nombre_sede', 'like', "%{$search}%"));
            });
        }

        if ($filter = $request->string('filter')->trim()->toString()) {
            $query->where('jornada', $filter);
        }

        if ($request->filled('ano_lectivo')) {
            $query->where('ano_lectivo', $request->input('ano_lectivo'));
        }

        $cursos = $query->get();
        $jornadas = Curso::whereNotNull('jornada')->distinct()->orderBy('jornada')->pluck('jornada', 'jornada');
        $anios = Curso::whereNotNull('ano_lectivo')->distinct()->orderByDesc('ano_lectivo')->pluck('ano_lectivo', 'ano_lectivo');

        return view('cursos.index', compact('cursos', 'jornadas', 'anios'));
    }

    public function create()
    {
        $sedes = Sede::all();
        $grados = Grado::all();
        $profesores = Profesor::all();
        return view('cursos.create', compact('sedes', 'grados', 'profesores'));
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
        $profesores = Profesor::all();
        return view('cursos.edit', compact('curso', 'sedes', 'grados', 'profesores'));
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
            'ano_lectivo' => 'nullable|string|max:20',
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
