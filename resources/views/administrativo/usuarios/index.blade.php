<x-layouts::app.sidebar title="Cuentas de usuario">
    <flux:main>
        <div class="mx-auto w-full max-w-7xl space-y-6">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div><p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión de usuarios</p><h1 class="mt-2 text-2xl font-bold text-zinc-800 dark:text-zinc-100">Cuentas de usuario</h1><p class="mt-1 text-sm text-zinc-500">Administra los accesos de profesores, administradores y estudiantes.</p></div>
                <flux:button class="w-full sm:w-auto" variant="primary" icon="plus" href="{{ route('administrativo.usuarios.create') }}">Registrar cuenta</flux:button>
            </div>

            @if (session('success'))<div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-950/30 dark:text-green-300">{{ session('success') }}</div>@endif

            <form method="GET" class="grid gap-3 rounded-2xl border border-zinc-200 bg-white p-4 sm:grid-cols-[1fr_auto_auto_auto] dark:border-zinc-800 dark:bg-zinc-900">
                <input name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o correo..." class="rounded-lg border-zinc-300 bg-white text-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100" />
                <select name="role" class="rounded-lg border-zinc-300 bg-white text-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100"><option value="">Todos los roles</option>@foreach($rolesPermitidos as $role)<option value="{{ $role }}" @selected(request('role') === $role)>{{ $role }}</option>@endforeach</select>
                <select name="filter" class="rounded-lg border-zinc-300 bg-white text-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100"><option value="">Todos los estados</option><option value="Activo" @selected(request('filter') === 'Activo')>Activo</option><option value="Inactivo" @selected(request('filter') === 'Inactivo')>Inactivo</option></select>
                <flux:button type="submit" variant="primary">Filtrar</flux:button>
            </form>

            <div class="overflow-x-auto rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                <table class="w-full min-w-[48rem] text-left text-sm text-zinc-600 dark:text-zinc-300"><thead class="bg-zinc-100 text-xs uppercase dark:bg-zinc-800"><tr><th class="p-3">Nombre</th><th class="p-3">Correo</th><th class="p-3">Rol</th><th class="p-3">Estado</th><th class="p-3 text-right">Acciones</th></tr></thead><tbody>
                    @forelse($usuarios as $usuario)
                        <tr class="border-b border-zinc-200 dark:border-zinc-800"><td class="p-3 font-medium text-zinc-800 dark:text-zinc-100">{{ $usuario->name }}</td><td class="p-3">{{ $usuario->email }}</td><td class="p-3">{{ $usuario->effective_role }}</td><td class="p-3"><span class="rounded px-2 py-1 text-xs {{ ($usuario->status ?? $usuario->estado) === 'Activo' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700' }}">{{ $usuario->status ?? $usuario->estado ?? 'Activo' }}</span></td><td class="p-3"><div class="flex justify-end gap-2"><flux:button size="sm" href="{{ route('administrativo.usuarios.edit', $usuario->id_users) }}">Editar</flux:button><form action="{{ route('administrativo.usuarios.destroy', $usuario->id_users) }}" method="POST">@csrf @method('DELETE')<flux:button size="sm" variant="danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</flux:button></form></div></td></tr>
                    @empty
                        <tr><td colspan="5" class="p-6 text-center text-zinc-500">No hay cuentas que coincidan con la búsqueda.</td></tr>
                    @endforelse
                </tbody></table>
                <div class="border-t border-zinc-200 p-4 dark:border-zinc-800">{{ $usuarios->links() }}</div>
            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
