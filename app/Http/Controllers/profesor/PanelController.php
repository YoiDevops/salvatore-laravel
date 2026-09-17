<?php

namespace App\Http\Controllers\profesor;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Estudiante\Estudiante;
use App\Models\Evaluacion\EscalaValoracion;
use App\Models\Evaluacion\IndicadorLogro;

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

    public function cursos()
    {
        $cursos = Curso::with(['grado', 'sede', 'estudiantes'])->orderBy('nombre_curso')->get();

        return view('profesor.cursos.index', compact('cursos'));
    }

    public function cursoShow(string $id)
    {
        $curso = Curso::with(['grado', 'sede', 'estudiantes' => function ($query) {
            $query->orderBy('apellidos_estudiante');
        }])->findOrFail($id);

        return view('profesor.cursos.show', compact('curso'));
    }

    public function estudiantes()
    {
        $estudiantes = Estudiante::with(['curso.grado'])->orderBy('apellidos_estudiante')->get();

        return view('profesor.estudiantes.index', compact('estudiantes'));
    }

    public function estudianteShow(string $id)
    {
        $estudiante = Estudiante::with(['curso.grado', 'curso.sede', 'acudiente'])->findOrFail($id);

        return view('profesor.estudiantes.show', compact('estudiante'));
    }

    public function asignaturas()
    {
        $asignaturas = Asignatura::with('area', 'indicadoresLogro')->orderBy('nombre_asignatura')->get();

        return view('profesor.asignaturas.index', compact('asignaturas'));
    }

    public function asignaturaShow(string $id)
    {
        $asignatura = Asignatura::with(['area', 'indicadoresLogro.periodo', 'indicadoresLogro.escalaValoracion'])->findOrFail($id);

        return view('profesor.asignaturas.show', compact('asignatura'));
    }

    public function grados()
    {
        $grados = Grado::withCount('cursos')->orderBy('nombre_grado')->get();

        return view('profesor.grados.index', compact('grados'));
    }

    public function gradoShow(string $id)
    {
        $grado = Grado::with('cursos')->findOrFail($id);

        return view('profesor.grados.show', compact('grado'));
    }

    public function escalas()
    {
        $escalas = EscalaValoracion::orderByDesc('nota_maxima')->get();

        return view('profesor.escalas.index', compact('escalas'));
    }

    public function escalaShow(string $id)
    {
        $escala = EscalaValoracion::with('indicadoresLogro.asignatura')->findOrFail($id);

        return view('profesor.escalas.show', compact('escala'));
    }

    public function indicadores()
    {
        $indicadores = IndicadorLogro::with(['asignatura', 'periodo', 'escalaValoracion'])->orderByDesc('id_indicador')->get();

        return view('profesor.indicadores.index', compact('indicadores'));
    }

    public function indicadorShow(string $id)
    {
        $indicador = IndicadorLogro::with(['asignatura', 'periodo', 'escalaValoracion'])->findOrFail($id);

        return view('profesor.indicadores.show', compact('indicador'));
    }
}
