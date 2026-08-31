<?php

namespace App\Http\Controllers\Evaluacion;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Evaluacion\EscalaValoracion;
use App\Models\Evaluacion\IndicadorLogro;
use App\Models\Evaluacion\Periodo;
use Illuminate\Http\Request;

class IndicadorLogroController extends Controller
{
    public function index()
    {
        $indicadores = IndicadorLogro::with('asignatura', 'periodo', 'escalaValoracion')->get();
        return view('indicadores.index', compact('indicadores'));
    }

    public function create()
    {
        $asignaturas = Asignatura::all();
        $periodos = Periodo::all();
        $escalas = EscalaValoracion::all();
        return view('indicadores.create', compact('asignaturas', 'periodos', 'escalas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_asignatura' => 'required|integer|exists:asignatura,id_asignatura',
            'id_periodo' => 'required|integer|exists:periodo,id_periodo',
            'id_escala' => 'required|integer|exists:escala_valoracion,id_escala',
            'codigo_logro' => 'nullable|string|max:20',
            'descripcion_logro' => 'required|string',
            'tipo_logro' => 'nullable|string|max:40',
        ]);

        IndicadorLogro::create($validated);

        return redirect()->route('indicadores.index')->with('success', 'Indicador de logro creado correctamente.');
    }

    public function show(string $id)
    {
        $indicador = IndicadorLogro::with('asignatura', 'periodo', 'escalaValoracion')->findOrFail($id);
        return view('indicadores.show', compact('indicador'));
    }

    public function edit(string $id)
    {
        $indicador = IndicadorLogro::findOrFail($id);
        $asignaturas = Asignatura::all();
        $periodos = Periodo::all();
        $escalas = EscalaValoracion::all();
        return view('indicadores.edit', compact('indicador', 'asignaturas', 'periodos', 'escalas'));
    }

    public function update(Request $request, string $id)
    {
        $indicador = IndicadorLogro::findOrFail($id);

        $validated = $request->validate([
            'id_asignatura' => 'required|integer|exists:asignatura,id_asignatura',
            'id_periodo' => 'required|integer|exists:periodo,id_periodo',
            'id_escala' => 'required|integer|exists:escala_valoracion,id_escala',
            'codigo_logro' => 'nullable|string|max:20',
            'descripcion_logro' => 'required|string',
            'tipo_logro' => 'nullable|string|max:40',
        ]);

        $indicador->update($validated);

        return redirect()->route('indicadores.index')->with('success', 'Indicador de logro actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $indicador = IndicadorLogro::findOrFail($id);
        $indicador->delete();

        return redirect()->route('indicadores.index')->with('success', 'Indicador de logro eliminado correctamente.');
    }
}
