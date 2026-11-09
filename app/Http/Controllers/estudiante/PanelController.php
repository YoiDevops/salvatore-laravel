<?php

namespace App\Http\Controllers\estudiante;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Estudiante\Estudiante;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function dashboard(Request $request)
    {
        $estudiante = Estudiante::with(['curso.grado', 'curso.sede'])
            ->where('id_usuario', $request->user()->id_users)
            ->first();

        $asignaturas = Asignatura::with('area')->orderBy('nombre_asignatura')->get();

        return view('estudiante.dashboard', compact('estudiante', 'asignaturas'));
    }
}
