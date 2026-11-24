<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use App\Models\Academico\Curso;
use App\Models\Estudiante\Acudiente;
use App\Models\Estudiante\CaracterizacionDiscapacidad;
use App\Models\Estudiante\Estudiante;
use App\Models\Profesor\Profesor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->managedAccountsQuery();
        if ($search = $request->input('search')) {
            $query->where(fn ($query) => $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"));
        }

        return view('administrativo.usuarios.index', [
            'usuarios' => $query->latest('id_users')->paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('administrativo.usuarios.create', [
            'rolInicial' => in_array(request('role'), ['Profesor', 'Estudiante'], true) ? request('role') : null,
            'cursos' => Curso::with('grado')->orderBy('nombre_curso')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['Profesor', 'Estudiante'])],
            'status' => ['required', Rule::in(['Activo', 'Inactivo'])],
        ];

        if ($request->input('role') === 'Profesor') {
            $rules += [
                'tipo_documento' => ['required', Rule::in(['CC', 'CE', 'PASAPORTE', 'PPT'])],
                'documento_profesor' => 'required|string|max:20|unique:profesor,documento_profesor',
                'nombres_profesor' => 'required|string|max:50',
                'apellidos_profesor' => 'required|string|max:50',
                'telefono_profesor' => 'nullable|string|max:20',
                'correo_profesor' => 'nullable|email|max:100',
                'direccion_residencia' => 'nullable|string|max:150',
                'fecha_ingreso_colegio' => 'nullable|date',
                'tipo_contra' => 'nullable|string|max:50',
                'estado_profesor' => ['nullable', Rule::in(['Activo', 'Inactivo', 'Licencia'])],
            ];
        }

        if ($request->input('role') === 'Estudiante') {
            $rules += [
                'id_curso' => ['required', 'integer', 'exists:curso,id_curso'],
                'tipo_documento' => ['required', Rule::in(['RC', 'TI', 'CC', 'CE', 'PASAPORTE', 'PPT'])],
                'documento_identidad' => 'required|string|max:20|unique:estudiante,documento_identidad',
                'nombres_estudiante' => 'required|string|max:50',
                'apellidos_estudiante' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date|before_or_equal:today',
                'genero' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
                'tipo_sangre' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
                'lugar_nacimiento' => 'required|string|max:80',
                'eps' => 'required|string|max:80',
                'estado_estudiante' => ['required', Rule::in(['Activo', 'Retirado', 'Graduado', 'Suspendido'])],
                'tiene_discapacidad' => ['required', Rule::in(['0', '1'])],
                'tipo_discapacidad' => 'required_if:tiene_discapacidad,1|nullable|string|max:60',
                'diagnostico' => 'nullable|string',
                'grado_discapacidad' => ['required_if:tiene_discapacidad,1', 'nullable', Rule::in(['Leve', 'Moderada', 'Severa'])],
                'permanencia' => ['required_if:tiene_discapacidad,1', 'nullable', Rule::in(['Temporal', 'Permanente'])],
                'grado_atencion' => 'nullable|string|max:80',

                'acudiente_tipo_documento' => ['required', Rule::in(['CC', 'TI', 'CE', 'PASAPORTE', 'PEP', 'PPT'])],
                'acudiente_numero_documento' => 'required|string|max:20|unique:acudiente,documento_identidad',
                'acudiente_nombres' => 'required|string|max:50',
                'acudiente_apellidos' => 'required|string|max:50',
                'acudiente_fecha_nacimiento' => 'required|date|before_or_equal:'.now()->subYears(18)->format('Y-m-d').'|after_or_equal:'.now()->subYears(150)->format('Y-m-d'),
                'acudiente_genero' => ['required', Rule::in(['Masculino', 'Femenino', 'Otro'])],
                'acudiente_parentesco' => 'required|string|max:30',
                'acudiente_direccion' => 'required|string|max:150',
                'acudiente_telefono' => 'required|string|max:20',
                'acudiente_correo' => 'required|email|max:100',
                'acudiente_lugar_trabajo' => 'nullable|string|max:100',
                'acudiente_ocupacion' => 'nullable|string|max:60',
            ];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($validated) {
            $usuario = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'status' => $validated['status'],
                'nom_rol' => $validated['role'],
                'estado' => $validated['status'],
            ]);

            if ($validated['role'] !== 'Profesor') {
                if ($validated['role'] !== 'Estudiante') {
                    return;
                }

                $acudiente = Acudiente::create([
                    'tipo_documento' => $validated['acudiente_tipo_documento'],
                    'documento_identidad' => $validated['acudiente_numero_documento'],
                    'nombres_acudiente' => $validated['acudiente_nombres'],
                    'apellidos_acudiente' => $validated['acudiente_apellidos'],
                    'fecha_nacimiento' => $validated['acudiente_fecha_nacimiento'],
                    'genero' => $validated['acudiente_genero'],
                    'parentesco_estudiante' => $validated['acudiente_parentesco'],
                    'direccion_residencia' => $validated['acudiente_direccion'],
                    'telefono_acudiente' => $validated['acudiente_telefono'],
                    'correo_acudiente' => $validated['acudiente_correo'],
                    'lugar_trabajo' => $validated['acudiente_lugar_trabajo'] ?? null,
                    'ocupacion' => $validated['acudiente_ocupacion'] ?? null,
                ]);

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

                Estudiante::create([
                    'id_usuario' => $usuario->id_users,
                    'id_curso' => $validated['id_curso'],
                    'id_acudiente' => $acudiente->id_acudiente,
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

                return;
            }

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
                'tipo_contra' => $validated['tipo_contra'] ?? null,
                'estado_profesor' => $validated['estado_profesor'] ?? $validated['status'],
            ]);
        });

        return redirect()->route('administrativo.usuarios.index')->with('success', 'Cuenta creada correctamente.');
    }

    public function show(User $usuario)
    {
        abort_unless($this->isManagedAccount($usuario), 404);

        return view('administrativo.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        abort_unless($this->isManagedAccount($usuario), 404);

        return view('administrativo.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        abort_unless($this->isManagedAccount($usuario), 404);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$usuario->id_users.',id_users',
            'role' => ['required', Rule::in(['Profesor', 'Estudiante'])],
            'status' => ['required', Rule::in(['Activo', 'Inactivo'])],
        ]);
        $usuario->update([
            ...$validated,
            'nom_rol' => $validated['role'],
            'estado' => $validated['status'],
            ...($request->filled('password') ? ['password' => Hash::make($request->input('password'))] : []),
        ]);

        return redirect()->route('administrativo.usuarios.index')->with('success', 'Cuenta actualizada correctamente.');
    }

    public function destroy(User $usuario)
    {
        abort_unless($this->isManagedAccount($usuario), 404);
        $usuario->delete();

        return redirect()->route('administrativo.usuarios.index')->with('success', 'Cuenta eliminada correctamente.');
    }

    private function managedAccountsQuery()
    {
        return User::query()->where(function ($query) {
            $query->whereRaw("LOWER(TRIM(COALESCE(role, ''))) IN (?, ?)", ['profesor', 'estudiante'])
                ->orWhereRaw("LOWER(TRIM(COALESCE(nom_rol, ''))) IN (?, ?)", ['profesor', 'estudiante']);
        });
    }

    private function isManagedAccount(User $usuario): bool
    {
        return in_array(strtolower(trim($usuario->effective_role)), ['profesor', 'estudiante'], true);
    }
}
