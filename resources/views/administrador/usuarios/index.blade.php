<x-layouts::app.sidebar title="Gestión de Usuarios">
    <flux:main>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Gestión de Usuarios</h1>
                <p class="text-sm text-zinc-500">Administración de cuentas registradas en la plataforma.</p>
            </div>
            <flux:button variant="primary" icon="plus" href="{{ route('usuarios.create') }}">
                Agregar Usuario
            </flux:button>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow p-4 border border-zinc-200 dark:border-zinc-800">
            <form method="GET" action="{{ route('usuarios.index') }}" class="mb-4 flex gap-2">
                <flux:input type="text" name="search" placeholder="Buscar por correo o usuario..." value="{{ request('search') }}" class="max-w-md" />
                <flux:button type="submit" variant="filled">Buscar</flux:button>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-600 dark:text-zinc-300">
                    <thead class="bg-zinc-100 dark:bg-zinc-800 uppercase text-xs">
                        <tr>
                            <th class="p-3">Seleccionar</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Correo</th>
                            <th class="p-3">Rol</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                            <tr class="border-b border-zinc-200 dark:border-zinc-800">
                                <td class="p-3"><input type="checkbox" name="selected[]" value="{{ $usuario->id_users }}"></td>
                                <td class="p-3">{{ $usuario->name ?? 'N/D' }}</td>
                                <td class="p-3">{{ $usuario->email }}</td>
                                <td class="p-3">{{ $usuario->role }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs rounded {{ $usuario->status == 'Activo' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700' }}">
                                        {{ $usuario->status ?? 'Activo' }}
                                    </span>
                                </td>
                                <td class="p-3 text-right space-x-2">
                                    <flux:button size="sm" href="{{ route('usuarios.edit', $usuario->id_users) }}">Editar</flux:button>
                                    <form action="{{ route('usuarios.destroy', $usuario->id_users) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button size="sm" variant="danger" type="submit" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</flux:button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-zinc-500">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>