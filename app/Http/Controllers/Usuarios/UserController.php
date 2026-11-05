<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuarios\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter')) {
            $query->where('status', $request->input('filter'));
        }

        if ($request->filled('role') && in_array($request->input('role'), $this->allowedRoles(), true)) {
            $role = $request->input('role');
            $query->where(function ($query) use ($role) {
                $query->whereRaw('TRIM(role) = ?', [$role])
                    ->orWhereRaw('TRIM(nom_rol) = ?', [$role]);
            });
        }

        $usuarios = $query->paginate(10)->withQueryString();

        return view($this->viewPath('index'), [
            'usuarios' => $usuarios,
            'rolesPermitidos' => $this->allowedRoles(),
        ]);
    }

    public function create()
    {
        $roles = collect($this->allowedRoles())
            ->map(fn (string $role) => (object) ['nombre_rol' => $role]);
        $rolInicial = request()->input('role');
        $rolInicial = in_array($rolInicial, $this->allowedRoles(), true) ? $rolInicial : null;

        return view($this->viewPath('create'), compact('roles', 'rolInicial'));
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return view($this->viewPath('show'), compact('usuario'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => ['required', 'string', Rule::in($this->allowedRoles())],
            'status' => ['required', Rule::in(['Activo', 'Inactivo'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nom_rol' => $validated['role'],
            'status' => $validated['status'],
            'estado' => $validated['status'],
        ]);

        return redirect()->route($this->routeName('index'))->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = collect($this->allowedRoles())
            ->map(fn (string $role) => (object) ['nombre_rol' => $role]);

        return view($this->viewPath('edit'), compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id.',id_users',
            'role' => ['required', 'string', Rule::in($this->allowedRoles())],
            'status' => ['required', Rule::in(['Activo', 'Inactivo'])],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nom_rol' => $validated['role'],
            'status' => $validated['status'],
            'estado' => $validated['status'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $usuario->update($data);

        return redirect()->route($this->routeName('index'))->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route($this->routeName('index'))->with('success', 'Usuario eliminado exitosamente.');
    }

    public function updatePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::findOrFail($id)->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route($this->routeName('index'))->with('success', 'Contraseña actualizada exitosamente.');
    }

    private function isAdministrativo(): bool
    {
        return strtolower((string) auth()->user()?->effective_role) === 'administrativo';
    }

    private function allowedRoles(): array
    {
        return $this->isAdministrativo()
            ? ['Administrador', 'Profesor', 'Estudiante']
            : Rol::query()->orderBy('nombre_rol')->pluck('nombre_rol')
                ->map(fn (string $role) => trim($role))
                ->filter()
                ->unique()
                ->values()
                ->all();
    }

    private function viewPath(string $view): string
    {
        return ($this->isAdministrativo() ? 'administrativo' : 'administrador').'.usuarios.'.$view;
    }

    private function routeName(string $route): string
    {
        return ($this->isAdministrativo() ? 'administrativo.' : '').'usuarios.'.$route;
    }
}
