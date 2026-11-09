<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['Profesor', 'Estudiante'])],
            'status' => ['required', Rule::in(['Activo', 'Inactivo'])],
        ]);

        User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
            'nom_rol' => $validated['role'],
            'estado' => $validated['status'],
        ]);

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
