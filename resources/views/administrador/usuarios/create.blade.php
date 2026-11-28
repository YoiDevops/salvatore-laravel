<x-layouts::app.sidebar title="Crear Usuario">
    <flux:main>
        <div class="max-w-xl mx-auto bg-white dark:bg-zinc-900 rounded-lg shadow p-6 border border-zinc-200 dark:border-zinc-800">
            <h1 class="text-xl font-bold mb-4 text-zinc-800 dark:text-zinc-100">Crear Nuevo Usuario</h1>
            <x-action-help class="mb-4">
                Escribe el nombre, correo y contraseña de ingreso; el rol define qué secciones podrá usar esta persona.
            </x-action-help>

            <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-4">
                @csrf

                <flux:input label="Nombre" name="name" value="{{ old('name') }}" required />
                <flux:input label="Correo Electrónico" type="email" name="email" value="{{ old('email') }}" required />
                <flux:input label="Contraseña" type="password" name="password" required />

                <flux:select label="Rol" name="role" required>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->nombre_rol }}" {{ old('role', 'Invitado') == $rol->nombre_rol ? 'selected' : '' }}>{{ $rol->nombre_rol }}</option>
                    @endforeach
                </flux:select>

                <flux:select label="Estado" name="status" required>
                    <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('status') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </flux:select>

                <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <flux:button class="w-full sm:w-auto" variant="ghost" href="{{ route('usuarios.index') }}">Cancelar</flux:button>
                    <flux:button class="w-full sm:w-auto" type="submit" variant="primary">Guardar Usuario</flux:button>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>