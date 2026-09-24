<?php

namespace App\Http\Controllers\estudiante;

use App\Http\Controllers\Controller;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Estudiante\Acudiente;
use App\Models\Estudiante\CaracterizacionDiscapacidad;
use App\Models\Estudiante\Estudiante;
use App\Models\Usuarios\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstudianteController extends Controller
{
    public function index(Request $request)
    {
        $query = Estudiante::with('usuario', 'curso', 'acudiente');

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('documento_identidad', 'like', "%{$search}%")
                    ->orWhere('nombres_estudiante', 'like', "%{$search}%")
                    ->orWhere('apellidos_estudiante', 'like', "%{$search}%")
                    ->orWhereHas('curso', fn ($query) => $query->where('nombre_curso', 'like', "%{$search}%"))
                    ->orWhereHas('acudiente', fn ($query) => $query->where('nombres_acudiente', 'like', "%{$search}%"));
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

        return view('estudiantes.index', compact('estudiantes', 'cursos', 'grados'));
    }

    public function create()
    {
        $cursos = Curso::with('grado')->get();
        $acudientes = Acudiente::all();
        return view('estudiantes.create', compact('cursos', 'acudientes'));
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

            // Discapacidad: el radio decide si los campos de abajo son obligatorios
            'tiene_discapacidad' => 'required|in:0,1',
            'tipo_discapacidad' => 'required_if:tiene_discapacidad,1|nullable|string|max:60',
            'diagnostico' => 'nullable|string',
            'grado_discapacidad' => 'required_if:tiene_discapacidad,1|nullable|in:Leve,Moderada,Severa',
            'permanencia' => 'required_if:tiene_discapacidad,1|nullable|in:Temporal,Permanente',
            'grado_atencion' => 'nullable|string|max:80',
        ]);

        // Si marco "Si", primero se crea la caracterizacion de discapacidad
        $idCaracterizacion = null;
        if ($validated['tiene_discapacidad'] === '1') {
            $caracterizacion = CaracterizacionDiscapacidad::create([
                'tipo_discapacidad' => $validated['tipo_discapacidad'],
                'diagnostico' => $validated['diagnostico'] ?? null,
                'grado_discapacidad' => $validated['grado_discapacidad'],
                'permanencia' => $validated['permanencia'],
                'grado_atencion' => $validated['grado_atencion'] ?? null,
            ]);
            $idCaracterizacion = $caracterizacion->id_caracterizacion;
        }

        // Crea la cuenta de usuario
        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nom_rol' => 'Estudiante',
        ]);

        // Luego el registro academico del estudiante, ligado al usuario y a la caracterizacion (si aplica)
        Estudiante::create([
            'id_usuario' => $usuario->id_users,
            'id_curso' => $validated['id_curso'],
            'id_acudiente' => $validated['id_acudiente'],
            'id_caracterizacion' => $idCaracterizacion,
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
        $estudiante = Estudiante::with('caracterizacion')->findOrFail($id);
        $cursos = Curso::with('grado')->get();
        $acudientes = Acudiente::all();
        return view('estudiantes.edit', compact('estudiante', 'cursos', 'acudientes'));
    }

    public function update(Request $request, string $id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $validated = $request->validate([
            'id_curso' => 'required|integer|exists:curso,id_curso',
            'id_acudiente' => 'required|integer|exists:acudiente,id_acudiente',
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

            'tiene_discapacidad' => 'required|in:0,1',
            'tipo_discapacidad' => 'required_if:tiene_discapacidad,1|nullable|string|max:60',
            'diagnostico' => 'nullable|string',
            'grado_discapacidad' => 'required_if:tiene_discapacidad,1|nullable|in:Leve,Moderada,Severa',
            'permanencia' => 'required_if:tiene_discapacidad,1|nullable|in:Temporal,Permanente',
            'grado_atencion' => 'nullable|string|max:80',
        ]);

        if ($validated['tiene_discapacidad'] === '1') {
            $datosCaracterizacion = [
                'tipo_discapacidad' => $validated['tipo_discapacidad'],
                'diagnostico' => $validated['diagnostico'] ?? null,
                'grado_discapacidad' => $validated['grado_discapacidad'],
                'permanencia' => $validated['permanencia'],
                'grado_atencion' => $validated['grado_atencion'] ?? null,
            ];

            if ($estudiante->id_caracterizacion) {
                // Ya tenia una: se actualiza en vez de crear otra
                CaracterizacionDiscapacidad::where('id_caracterizacion', $estudiante->id_caracterizacion)
                    ->update($datosCaracterizacion);
            } else {
                // No tenia: se crea y se liga al estudiante
                $caracterizacion = CaracterizacionDiscapacidad::create($datosCaracterizacion);
                $estudiante->id_caracterizacion = $caracterizacion->id_caracterizacion;
            }
        } else {
            // Marco "No": se desvincula del estudiante (la caracterizacion no se borra por si se requiere despues)
            $estudiante->id_caracterizacion = null;
        }

        $estudiante->fill($validated);
        $estudiante->save();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }
}