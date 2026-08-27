<?php

namespace App\Http\Controllers;

use App\Models\EscalaValoracion;
use Illuminate\Http\Request;

class EscalaValoracionController extends Controller
{
    public function index()
    {
        $escalas = EscalaValoracion::all();
        return view('escalas.index', compact('escalas'));
    }

    public function create()
    {
        return view('escalas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_desempeno' => 'required|in:Superior,Alto,Basico,Bajo',
            'nota_minima' => 'required|numeric|min:0|max:9',
            'nota_maxima' => 'required|numeric|min:0|max:99999',
            'definicion_escala' => 'nullable|string',
        ]);

        EscalaValoracion::create($validated);

        return redirect()->route('escalas.index')->with('success', 'Escala de valoración creada correctamente.');
    }

    public function show(string $id)
    {
        $escala = EscalaValoracion::with('indicadoresLogro')->findOrFail($id);
        return view('escalas.show', compact('escala'));
    }

    public function edit(string $id)
    {
        $escala = EscalaValoracion::findOrFail($id);
        return view('escalas.edit', compact('escala'));
    }

    public function update(Request $request, string $id)
    {
        $escala = EscalaValoracion::findOrFail($id);

        $validated = $request->validate([
            'nombre_desempeno' => 'required|in:Superior,Alto,Basico,Bajo',
            'nota_minima' => 'required|numeric|min:0|max:9',
            'nota_maxima' => 'required|numeric|min:0|max:99999',
            'definicion_escala' => 'nullable|string',
        ]);

        $escala->update($validated);

        return redirect()->route('escalas.index')->with('success', 'Escala de valoración actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $escala = EscalaValoracion::findOrFail($id);
        $escala->delete();

        return redirect()->route('escalas.index')->with('success', 'Escala de valoración eliminada correctamente.');
    }
}
