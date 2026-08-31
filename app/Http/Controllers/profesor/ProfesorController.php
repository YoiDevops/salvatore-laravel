<?php

namespace App\Http\Controllers\profesor;

use App\Http\Controllers\Controller;
use App\Models\Profesor\Profesor;
use App\Models\Usuarios\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::with('usuario')->get();
        return view('profesores.index', compact('profesores'));
    }

    public function create()
    {
        return view('profesores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Datos de la cuenta de usuario asociada
            'name' => 'required|string|max:30|unique:users,name',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',

            // Datos del profesor
            'tipo_documento' => 'required|in:CC,CE,PASAPORTE,PPT',
            'documento_profesor' => 'required|string|max:20|unique:profesor,documento_profesor',
            'nombres_profesor' => 'required|string|max:50',
            'apellidos_profesor' => 'required|string|max:50',
            'telefono_profesor' => 'nullable|string|max:20',
            'correo_profesor' => 'nullable|email|max:100',
            'direccion_residencia' => 'nullable|string|max:150',
            'fecha_ingreso_colegio' => 'nullable|date',
            'tipo_contra' => 'nullable|string|max:50', // <-- Agregado
            'estado_profesor' => 'nullable|in:Activo,Inactivo,Licencia',
        ]);

        $usuario = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nom_rol' => 'Profesor',
        ]);

        Profesor::create([
            'id_usuario' => $usuario->id_users,
            'tipo_documento' => $validated['tipo_documento'],
            'documento_profesor' => $validated['documento_profesor'],
            'nombres_profesor' => $validated['nombres_profesor'],
            'apellidos_profesor' => $validated['apellidos_profesor'],
            'telefono_profesor' => $validated['telefono_profesor'] ?? null,
            'correo_profesor' => $validated['correo_profesor'] ?? null,
            'direccion_residencia' => $validated['direccion_residencia'] ?? null,
            'fecha_ingreso_colegio' => $validated['fecha_ingreso_colegio'] ?? null,
            'tipo_contra' => $validated['tipo_contra'] ?? null, // <-- Agregado
            'estado_profesor' => $validated['estado_profesor'] ?? 'Activo',
        ]);

        return redirect()->route('profesores.index')->with('success', 'Profesor creado correctamente.');
    }

    public function show(string $id)
    {
        $profesor = Profesor::with('usuario')->findOrFail($id);
        return view('profesores.show', compact('profesor'));
    }

    public function edit(string $id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('profesores.edit', compact('profesor'));
    }

    public function update(Request $request, string $id)
    {
        $profesor = Profesor::findOrFail($id);

        $validated = $request->validate([
            'tipo_documento' => 'required|in:CC,CE,PASAPORTE,PPT',
            'documento_profesor' => 'required|string|max:20|unique:profesor,documento_profesor,' . $id . ',id_profesor',
            'nombres_profesor' => 'required|string|max:50',
            'apellidos_profesor' => 'required|string|max:50',
            'telefono_profesor' => 'nullable|string|max:20',
            'correo_profesor' => 'nullable|email|max:100',
            'direccion_residencia' => 'nullable|string|max:150',
            'fecha_ingreso_colegio' => 'nullable|date',
            'tipo_contra' => 'nullable|string|max:50', // <-- Agregado
            'estado_profesor' => 'nullable|in:Activo,Inactivo,Licencia',
        ]);

        $profesor->update($validated);

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();

        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado correctamente.');
    }
}