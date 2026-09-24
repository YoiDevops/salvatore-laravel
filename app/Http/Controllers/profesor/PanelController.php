<?php

namespace App\Http\Controllers\profesor;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Estudiante\Estudiante;
use App\Models\Evaluacion\EscalaValoracion;
use App\Models\Evaluacion\IndicadorLogro;
use App\Models\Evaluacion\Periodo;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Panel principal del profesor: mismo lenguaje visual del panel
     * administrativo, pero limitado a las secciones que el docente puede
     * consultar (estudiantes, cursos, grados, asignaturas y evaluación).
     */
    public function dashboard()
    {
        $stats = [
            'cursos' => Curso::count(),
            'estudiantes' => Estudiante::count(),
            'asignaturas' => Asignatura::count(),
            'grados' => Grado::count(),
        ];

        return view('profesor.dashboard', compact('stats'));
    }

    public function cursos(Request $request)
    {
        $query = Curso::with(['grado', 'sede', 'estudiantes'])->orderBy('nombre_curso');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_curso', 'like', "%{$search}%")
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

        return view('profesor.cursos.index', compact('cursos', 'jornadas', 'anios'));
    }

    public function cursoShow(string $id)
    {
        $curso = Curso::with(['grado', 'sede', 'estudiantes' => function ($query) {
            $query->orderBy('apellidos_estudiante');
        }])->findOrFail($id);

        return view('profesor.cursos.show', compact('curso'));
    }

    public function estudiantes(Request $request)
    {
        $query = Estudiante::with(['curso.grado'])->orderBy('apellidos_estudiante');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('nombres_estudiante', 'like', "%{$search}%")
                    ->orWhere('apellidos_estudiante', 'like', "%{$search}%")
                    ->orWhere('documento_identidad', 'like', "%{$search}%")
                    ->orWhereHas('curso', fn ($query) => $query->where('nombre_curso', 'like', "%{$search}%"));
            });
        }

        if ($filter = $request->string('filter')->trim()->toString()) {
            $query->where('estado_estudiante', $filter);
        }

        if ($request->filled('curso')) {
            $query->where('id_curso', $request->input('curso'));
        }

        if ($request->filled('genero')) {
            $query->where('genero', $request->input('genero'));
        }

        if ($request->filled('grado')) {
            $query->whereHas('curso', fn ($query) => $query->where('id_grado', $request->input('grado')));
        }

        $estudiantes = $query->get();
        $cursos = Curso::orderBy('nombre_curso')->get(['id_curso', 'nombre_curso']);
        $grados = Grado::orderBy('nombre_grado')->get(['id_grado', 'nombre_grado']);

        return view('profesor.estudiantes.index', compact('estudiantes', 'cursos', 'grados'));
    }

    public function estudianteShow(string $id)
    {
        $estudiante = Estudiante::with(['curso.grado', 'curso.sede', 'acudiente'])->findOrFail($id);

        return view('profesor.estudiantes.show', compact('estudiante'));
    }

    public function asignaturas(Request $request)
    {
        $query = Asignatura::with('area', 'indicadoresLogro')->orderBy('nombre_asignatura');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_asignatura', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%")
                    ->orWhereHas('area', fn ($query) => $query->where('nombre_area', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('area')) {
            $query->where('id_area', $request->input('area'));
        }

        $asignaturas = $query->get();
        $areas = \App\Models\Academico\Area::orderBy('nombre_area')->get(['id_area', 'nombre_area']);

        return view('profesor.asignaturas.index', compact('asignaturas', 'areas'));
    }

    public function asignaturaShow(string $id)
    {
        $asignatura = Asignatura::with(['area', 'indicadoresLogro.periodo', 'indicadoresLogro.escalaValoracion'])->findOrFail($id);

        return view('profesor.asignaturas.show', compact('asignatura'));
    }

    public function grados(Request $request)
    {
        $query = Grado::withCount('cursos')->orderBy('nombre_grado');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where('nombre_grado', 'like', "%{$search}%");
        }

        if ($request->input('filter') === 'con_cursos') {
            $query->has('cursos');
        } elseif ($request->input('filter') === 'sin_cursos') {
            $query->doesntHave('cursos');
        }

        $grados = $query->get();

        return view('profesor.grados.index', compact('grados'));
    }

    public function gradoShow(string $id)
    {
        $grado = Grado::with('cursos')->findOrFail($id);

        return view('profesor.grados.show', compact('grado'));
    }

    public function escalas(Request $request)
    {
        $query = EscalaValoracion::orderByDesc('nota_maxima');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_desempeno', 'like', "%{$search}%")
                    ->orWhere('definicion_escala', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter')) {
            $query->where('nombre_desempeno', $request->input('filter'));
        }

        $escalas = $query->get();

        return view('profesor.escalas.index', compact('escalas'));
    }

    public function escalaShow(string $id)
    {
        $escala = EscalaValoracion::with('indicadoresLogro.asignatura')->findOrFail($id);

        return view('profesor.escalas.show', compact('escala'));
    }

    public function indicadores(Request $request)
    {
        $query = IndicadorLogro::with(['asignatura', 'periodo', 'escalaValoracion'])->orderByDesc('id_indicador');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('codigo_logro', 'like', "%{$search}%")
                    ->orWhere('descripcion_logro', 'like', "%{$search}%")
                    ->orWhereHas('asignatura', fn ($query) => $query->where('nombre_asignatura', 'like', "%{$search}%"))
                    ->orWhereHas('periodo', fn ($query) => $query->where('nombre_periodo', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('periodo')) {
            $query->where('id_periodo', $request->input('periodo'));
        }

        if ($request->filled('escala')) {
            $query->where('id_escala', $request->input('escala'));
        }

        $indicadores = $query->get();
        $periodos = Periodo::orderBy('anio_lectivo')->orderBy('nombre_periodo')->get(['id_periodo', 'nombre_periodo']);
        $escalas = EscalaValoracion::orderBy('nombre_desempeno')->get(['id_escala', 'nombre_desempeno']);

        return view('profesor.indicadores.index', compact('indicadores', 'periodos', 'escalas'));
    }

    public function indicadorShow(string $id)
    {
        $indicador = IndicadorLogro::with(['asignatura', 'periodo', 'escalaValoracion'])->findOrFail($id);

        return view('profesor.indicadores.show', compact('indicador'));
    }
}
