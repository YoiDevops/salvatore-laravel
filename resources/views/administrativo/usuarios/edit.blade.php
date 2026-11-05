<x-layouts::app.sidebar title="Editar cuenta">
    <flux:main>
        <div class="mx-auto max-w-xl rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <h1 class="mb-1 text-xl font-bold text-zinc-800 dark:text-zinc-100">Editar cuenta</h1><p class="mb-6 text-sm text-zinc-500">Actualiza los datos de acceso de {{ $usuario->name }}.</p>
            @if ($errors->any())<div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <form action="{{ route('administrativo.usuarios.update', $usuario->id_users) }}" method="POST" class="space-y-4">@csrf @method('PUT')
                <flux:input label="Nombre de usuario" name="name" :value="old('name', $usuario->name)" required />
                <flux:input label="Correo electrónico" type="email" name="email" :value="old('email', $usuario->email)" required />
                <flux:input label="Nueva contraseña (opcional)" type="password" name="password" />
                <flux:select label="Rol" name="role" required>@foreach($roles as $rol)<option value="{{ $rol->nombre_rol }}" @selected(old('role', $usuario->role ?? $usuario->nom_rol) === $rol->nombre_rol)>{{ $rol->nombre_rol }}</option>@endforeach</flux:select>
                <flux:select label="Estado" name="status" required><option value="Activo" @selected(old('status', $usuario->status ?? $usuario->estado) === 'Activo')>Activo</option><option value="Inactivo" @selected(old('status', $usuario->status ?? $usuario->estado) === 'Inactivo')>Inactivo</option></flux:select>
                <div class="flex justify-end gap-2 pt-4"><flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Cancelar</flux:button><flux:button type="submit" variant="primary">Actualizar cuenta</flux:button></div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
