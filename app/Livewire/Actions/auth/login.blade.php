<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth')] class extends Component {
    public string $usuario = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $usernameColumn = Schema::hasColumn('users', 'usuario') ? 'usuario' : 'name';
        $emailColumn = Schema::hasColumn('users', 'correo') ? 'correo' : 'email';
        $roleColumn = Schema::hasColumn('users', 'id_rol') ? 'id_rol' : 'nom_rol';

        $user = User::where($usernameColumn, $this->usuario)
            ->orWhere($emailColumn, $this->usuario)
            ->first();

        if (! $user) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        // Validar estado (tu regla vieja)
        if ($user->estado !== 'Activo') {
            $this->addError('usuario', 'El usuario se encuentra inactivo.');
            return;
        }

        $loginColumn = filter_var($this->usuario, FILTER_VALIDATE_EMAIL)
            ? $emailColumn
            : $usernameColumn;

        if (! Auth::attempt([$loginColumn => $this->usuario, 'password' => $this->password])) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        request()->session()->regenerate();

        $role = $user->{$roleColumn};
        $this->redirect(match ((int) $role) {
            1 => '/admin/dashboard',
            2 => '/profesor/dashboard',
            3 => '/estudiante/dashboard',
            default => '/',
        }, navigate: true);
    }
}; ?>

<div class="banner-login">
    <form wire:submit="login" class="form-login">
        <h2>INICIAR SESIÓN</h2>

        <div class="entrada">
            <label>Usuario o correo</label>
            <input type="text" wire:model="usuario" required autofocus>
            @error('usuario') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="entrada">
            <label>Contraseña</label>
            <input type="password" wire:model="password" required>
        </div>

        <div class="boton">
            <button type="submit">Ingresar</button>
        </div>
    </form>
</div>