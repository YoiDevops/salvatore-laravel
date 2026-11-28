<?php

namespace App\Http\Controllers\Academico;

use App\Http\Controllers\Controller;
use App\Models\Academico\Asignatura;
use App\Models\Academico\Carga;
use App\Models\Academico\Curso;
use App\Models\Profesor\Profesor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CargaController extends Controller
{
    public function index(Request $request): View
    {
        $cargas = Carga::query()
            ->with(['curso.grado', 'asignatura', 'profesor'])
            ->when($request->filled('search'), function (Builder $query) use ($request): void {
                $search = trim((string) $request->input('search'));
                $query->where(function (Builder $query) use ($search): void {
                    $query->whereHas('curso', fn (Builder $query) => $query->where('nombre_curso', 'like', "%{$search}%"))
                        ->orWhereHas('asignatura', fn (Builder $query) => $query->where('nombre_asignatura', 'like', "%{$search}%"))
                        ->orWhereHas('profesor', fn (Builder $query) => $query
                            ->where('nombres_profesor', 'like', "%{$search}%")
                            ->orWhere('apellidos_profesor', 'like', "%{$search}%"));
                });
            })
            ->orderBy('id_carga')
            ->paginate(15)
            ->withQueryString();

        return view('cargas.index', compact('cargas'));
    }

    public function create(): View
    {
        return view('cargas.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules($request));
        Carga::create($validated + ['intensidad_horaria' => null]);

        return to_route('cargas.index')->with('success', 'La asignación académica quedó guardada.');
    }

    public function show(Carga $carga): View
    {
        $carga->load(['curso.grado', 'asignatura', 'profesor']);

        return view('cargas.show', compact('carga'));
    }

    public function edit(Carga $carga): View
    {
        return view('cargas.edit', $this->formOptions() + compact('carga'));
    }

    public function update(Request $request, Carga $carga): RedirectResponse
    {
        $validated = $request->validate($this->rules($request, $carga));
        $carga->update($validated + ['intensidad_horaria' => null]);

        return to_route('cargas.index')->with('success', 'La asignación académica quedó actualizada.');
    }

    public function destroy(Carga $carga): RedirectResponse
    {
        $carga->delete();

        return to_route('cargas.index')->with('success', 'La asignación académica se eliminó.');
    }

    private function formOptions(): array
    {
        return [
            'cursos' => Curso::with('grado')->orderBy('nombre_curso')->get(),
            'asignaturas' => Asignatura::orderBy('nombre_asignatura')->get(),
            'profesores' => Profesor::orderBy('apellidos_profesor')->orderBy('nombres_profesor')->get(),
        ];
    }

    private function rules(Request $request, ?Carga $carga = null): array
    {
        $profesorRule = Rule::unique('carga_academica', 'id_profesor')
            ->where('id_curso', $request->input('id_curso'))
            ->where('id_asignatura', $request->input('id_asignatura'));

        if ($carga) {
            $profesorRule->ignore($carga->id_carga, 'id_carga');
        }

        return [
            'id_curso' => ['required', 'integer', 'exists:curso,id_curso'],
            'id_asignatura' => ['required', 'integer', 'exists:asignatura,id_asignatura'],
            'id_profesor' => ['required', 'integer', 'exists:profesor,id_profesor', $profesorRule],
            'intensidad_horaria' => ['nullable', 'integer', 'min:1', 'max:255'],
        ];
    }
}
