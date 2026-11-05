<x-layouts::app.sidebar title="Registrar cuenta">
    <flux:main>
        <div class="mx-auto max-w-xl rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Nueva cuenta</p><h1 class="mt-2 text-xl font-bold text-zinc-800 dark:text-zinc-100">Registrar usuario</h1><p class="mt-1 mb-6 text-sm text-zinc-500">La cuenta quedará disponible para iniciar sesión con el rol seleccionado.</p>
            @if ($errors->any())<div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <form action="{{ route('administrativo.usuarios.store') }}" method="POST" class="space-y-4">@csrf
                <flux:input label="Nombre de usuario" name="name" :value="old('name')" required />
                <flux:input label="Correo electrónico" type="email" name="email" :value="old('email')" required />
                <flux:input label="Contraseña" type="password" name="password" required />
                <flux:select label="Rol" name="role" required><option value="">Seleccione un rol</option>@foreach($roles as $rol)<option value="{{ $rol->nombre_rol }}" @selected(old('role', $rolInicial) === $rol->nombre_rol)>{{ $rol->nombre_rol }}</option>@endforeach</flux:select>
                <flux:select label="Estado" name="status" required><option value="Activo" @selected(old('status', 'Activo') === 'Activo')>Activo</option><option value="Inactivo" @selected(old('status') === 'Inactivo')>Inactivo</option></flux:select>
                <div class="flex justify-end gap-2 pt-4"><flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Cancelar</flux:button><flux:button type="submit" variant="primary">Guardar cuenta</flux:button></div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
