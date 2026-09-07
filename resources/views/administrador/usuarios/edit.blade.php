<x-layouts::app.sidebar title="Editar Usuario">
    <flux:main>
        <div class="max-w-xl mx-auto bg-white dark:bg-zinc-900 rounded-lg shadow p-6 border border-zinc-200 dark:border-zinc-800">
            <h1 class="text-xl font-bold mb-4 text-zinc-800 dark:text-zinc-100">Editar Usuario</h1>

            <form action="{{ route('usuarios.update', $usuario->id_users) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <flux:input label="Nombre" name="name" value="{{ old('name', $usuario->name) }}" required />
                <flux:input label="Correo Electrónico" type="email" name="email" value="{{ old('email', $usuario->email) }}" required />
                <flux:input label="Contraseña (dejar en blanco para no cambiar)" type="password" name="password" />

                <flux:select label="Rol" name="role" required>
                    <option value="Administrador" {{ old('role', $usuario->role) == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="Usuario" {{ old('role', $usuario->role) == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                </flux:select>

                <flux:select label="Estado" name="status" required>
                    <option value="Activo" {{ old('status', $usuario->status) == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('status', $usuario->status) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </flux:select>

                <div class="flex justify-end gap-2 mt-6">
                    <flux:button variant="ghost" href="{{ route('usuarios.index') }}">Cancelar</flux:button>
                    <flux:button type="submit" variant="primary">Actualizar Usuario</flux:button>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>