<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\User;
use App\Models\Curso;
use App\Models\Acudiente;
use App\Models\CaracterizacionDiscapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::with('usuario', 'curso', 'acudiente')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $acudientes = Acudiente::all();
        $caracterizaciones = CaracterizacionDiscapacidad::all();
        return view('estudiantes.create', compact('cursos', 'acudientes', 'caracterizaciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos de la cuenta de usuario asociada
            'name' => 'required|string|max:30|unique:users,name',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',

            // Datos del estudiante
            'id_curso' => 'required|integer|exists:curso,id_curso',
            'id_acudiente' => 'required|integer|exists:acudiente,id_acudiente',
            'id_caracterizacion' => 'nullable|integer|exists:caracterizacion_discapacidad,id_caracterizacion',
            'tipo_documento' => 'required|in:RC,TI,CC,CE,PASAPORTE,PPT',
            'documento_identidad' => 'required|string|max:20|unique:estudiante,documento_identidad',
            'nombres_estudiante' => 'required|string|max:50',
            'apellidos_estudiante' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'tipo_sangre' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'lugar_nacimiento' => 'nullable|string|max:80',
            'eps' => 'nullable|string|max:80',
            'estado_estudiante' => 'nullable|in:Activo,Retirado,Graduado,Suspendido',
        ]);

        // Crea primero la cuenta de usuario
        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nom_rol' => 'Estudiante',
        ]);

        // Luego el registro académico del estudiante, ligado al usuario
        Estudiante::create([
            'id_usuario' => $usuario->id_users,
            'id_curso' => $validated['id_curso'],
            'id_acudiente' => $validated['id_acudiente'],
            'id_caracterizacion' => $validated['id_caracterizacion'] ?? null,
            'tipo_documento' => $validated['tipo_documento'],
            'documento_identidad' => $validated['documento_identidad'],
            'nombres_estudiante' => $validated['nombres_estudiante'],
            'apellidos_estudiante' => $validated['apellidos_estudiante'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'genero' => $validated['genero'],
            'tipo_sangre' => $validated['tipo_sangre'],
            'lugar_nacimiento' => $validated['lugar_nacimiento'] ?? null,
            'eps' => $validated['eps'] ?? null,
            'estado_estudiante' => $validated['estado_estudiante'] ?? 'Activo',
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado correctamente.');
    }

    public function show(string $id)
    {
        $estudiante = Estudiante::with('usuario', 'curso', 'acudiente', 'caracterizacion')->findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $cursos = Curso::all();
        $acudientes = Acudiente::all();
        $caracterizaciones = CaracterizacionDiscapacidad::all();
        return view('estudiantes.edit', compact('estudiante', 'cursos', 'acudientes', 'caracterizaciones'));
    }

    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $validated = $request->validate([
            'id_curso' => 'required|integer|exists:curso,id_curso',
            'id_acudiente' => 'required|integer|exists:acudiente,id_acudiente',
            'id_caracterizacion' => 'nullable|integer|exists:caracterizacion_discapacidad,id_caracterizacion',
            'tipo_documento' => 'required|in:RC,TI,CC,CE,PASAPORTE,PPT',
            'documento_identidad' => 'required|string|max:20|unique:estudiante,documento_identidad,' . $id . ',id_estudiante',
            'nombres_estudiante' => 'required|string|max:50',
            'apellidos_estudiante' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'tipo_sangre' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'lugar_nacimiento' => 'nullable|string|max:80',
            'eps' => 'nullable|string|max:80',
            'estado_estudiante' => 'nullable|in:Activo,Retirado,Graduado,Suspendido',
        ]);

        $estudiante->update($validated);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }
}
