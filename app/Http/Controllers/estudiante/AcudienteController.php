<?php

namespace App\Http\Controllers\estudiante;

use App\Http\Controllers\Controller;
use App\Models\Estudiante\Acudiente;
use Illuminate\Http\Request;

class AcudienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Acudiente::query();

        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(function ($query) use ($search) {
                $query->where('documento_identidad', 'like', "%{$search}%")
                    ->orWhere('nombres_acudiente', 'like', "%{$search}%")
                    ->orWhere('apellidos_acudiente', 'like', "%{$search}%")
                    ->orWhere('correo_acudiente', 'like', "%{$search}%");
            });
        }

        if ($filter = $request->string('filter')->trim()->toString()) {
            $query->where('parentesco_estudiante', $filter);
        }

        $acudientes = $query->get();
        $parentescos = Acudiente::query()
            ->whereNotNull('parentesco_estudiante')
            ->where('parentesco_estudiante', '<>', '')
            ->distinct()
            ->orderBy('parentesco_estudiante')
            ->pluck('parentesco_estudiante');

        return view('acudientes.index', compact('acudientes', 'parentescos'));
    }

    public function create()
    {
        return view('acudientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_documento' => 'required|in:CC,TI,CE,PASAPORTE,PEP,PPT',
            'documento_identidad' => 'required|string|max:20|unique:acudiente,documento_identidad',
            'nombres_acudiente' => 'required|string|max:50',
            'apellidos_acudiente' => 'required|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'parentesco_estudiante' => 'required|string|max:30',
            'direccion_residencia' => 'nullable|string|max:150',
            'telefono_acudiente' => 'nullable|string|max:20',
            'correo_acudiente' => 'nullable|email|max:100',
            'lugar_trabajo' => 'nullable|string|max:100',
            'ocupacion' => 'nullable|string|max:60',
        ]);

        Acudiente::create($validated);

        return redirect()->route('acudientes.index')->with('success', 'Acudiente creado correctamente.');
    }

    public function show(string $id)
    {
        $acudiente = Acudiente::with('estudiantes')->findOrFail($id);
        return view('acudientes.show', compact('acudiente'));
    }

    public function edit(string $id)
    {
        $acudiente = Acudiente::findOrFail($id);
        return view('acudientes.edit', compact('acudiente'));
    }

    public function update(Request $request, string $id)
    {
        $acudiente = Acudiente::findOrFail($id);

        $validated = $request->validate([
            'tipo_documento' => 'required|in:CC,TI,CE,PASAPORTE,PEP,PPT',
            'documento_identidad' => 'required|string|max:20|unique:acudiente,documento_identidad,' . $id . ',id_acudiente',
            'nombres_acudiente' => 'required|string|max:50',
            'apellidos_acudiente' => 'required|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'parentesco_estudiante' => 'required|string|max:30',
            'direccion_residencia' => 'nullable|string|max:150',
            'telefono_acudiente' => 'nullable|string|max:20',
            'correo_acudiente' => 'nullable|email|max:100',
            'lugar_trabajo' => 'nullable|string|max:100',
            'ocupacion' => 'nullable|string|max:60',
        ]);

        $acudiente->update($validated);

        return redirect()->route('acudientes.index')->with('success', 'Acudiente actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $acudiente = Acudiente::findOrFail($id);
        $acudiente->delete();

        return redirect()->route('acudientes.index')->with('success', 'Acudiente eliminado correctamente.');
    }
}
