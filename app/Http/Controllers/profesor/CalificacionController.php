<?php

namespace App\Http\Controllers\profesor;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Academico\Curso;
use App\Models\Estudiante\Estudiante;
use App\Models\Evaluacion\Calificacion;
use App\Models\Evaluacion\EscalaValoracion;
use App\Models\Evaluacion\IndicadorLogro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CalificacionController extends Controller
{
    public function create(Curso $curso, Estudiante $estudiante): View
    {
        $this->ensureStudentBelongsToCourse($curso, $estudiante);

        $asignaturas = Asignatura::query()
            ->with(['indicadoresLogro' => function ($query) {
                $query->with('periodo')
                    ->orderBy('id_periodo')
                    ->orderBy('id_indicador');
            }])
            ->whereHas('indicadoresLogro')
            ->orderBy('nombre_asignatura')
            ->get();

        $calificaciones = Calificacion::query()
            ->with(['indicador.asignatura', 'indicador.periodo', 'escalaValoracion'])
            ->where('id_estudiante', $estudiante->id_estudiante)
            ->orderByDesc('updated_at')
            ->get();

        return view('profesor.calificaciones.create', [
            'curso' => $curso,
            'estudiante' => $estudiante,
            'asignaturas' => $asignaturas,
            'calificaciones' => $calificaciones,
            'calificacionesPorIndicador' => $calificaciones->keyBy('id_indicador'),
            'indicadorSeleccionado' => (int) request()->query('indicador'),
            'notaMinima' => EscalaValoracion::query()->min('nota_minima'),
            'notaMaxima' => EscalaValoracion::query()->max('nota_maxima'),
        ]);
    }

    public function store(Request $request, Curso $curso, Estudiante $estudiante): RedirectResponse
    {
        $this->ensureStudentBelongsToCourse($curso, $estudiante);

        $notaMinima = EscalaValoracion::query()->min('nota_minima');
        $notaMaxima = EscalaValoracion::query()->max('nota_maxima');

        if ($notaMinima === null || $notaMaxima === null) {
            throw ValidationException::withMessages([
                'nota' => 'No hay una escala de valoración configurada para registrar notas.',
            ]);
        }

        $validated = $request->validate([
            'id_indicador' => ['required', 'integer', 'exists:indicador_logro,id_indicador'],
            'nota' => [
                'required',
                'numeric',
                'decimal:0,2',
                'min:'.$notaMinima,
                'max:'.$notaMaxima,
            ],
        ], [], [
            'id_indicador' => 'indicador de logro',
            'nota' => 'nota',
        ]);

        $indicador = IndicadorLogro::query()
            ->whereHas('asignatura')
            ->whereHas('periodo')
            ->whereKey($validated['id_indicador'])
            ->firstOrFail();

        $nota = (float) $validated['nota'];
        $escala = EscalaValoracion::query()
            ->where('nota_minima', '<=', $nota)
            ->orderByDesc('nota_minima')
            ->orderBy('id_escala')
            ->first();

        if ($escala === null) {
            throw ValidationException::withMessages([
                'nota' => 'La nota no corresponde a ningún nivel de la escala de valoración.',
            ]);
        }

        DB::transaction(function () use ($estudiante, $indicador, $escala, $nota): void {
            Calificacion::query()->updateOrCreate(
                [
                    'id_estudiante' => $estudiante->id_estudiante,
                    'id_indicador' => $indicador->id_indicador,
                ],
                [
                    'id_escala' => $escala->id_escala,
                    'nota' => $nota,
                ],
            );
        });

        return to_route('profesor.cursos.estudiantes.calificaciones.create', [
            'curso' => $curso->id_curso,
            'estudiante' => $estudiante->id_estudiante,
            'indicador' => $indicador->id_indicador,
        ])->with('success', 'La nota se guardó correctamente.');
    }

    private function ensureStudentBelongsToCourse(Curso $curso, Estudiante $estudiante): void
    {
        abort_unless((int) $estudiante->id_curso === (int) $curso->id_curso, 404);
    }
}
