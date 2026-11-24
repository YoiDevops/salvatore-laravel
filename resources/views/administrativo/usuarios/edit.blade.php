<x-layouts::app.sidebar title="Editar cuenta">
    <flux:main>
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#c49a35]">Administración de cuentas</p>
                    <flux:heading size="xl" class="mt-2">Editar cuenta</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Actualiza los datos y permisos de esta cuenta.</p>
                </div>
                <a href="{{ route('administrativo.usuarios.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-500 transition hover:text-[#9a761f]">
                    <flux:icon name="arrow-left" class="size-4" /> Volver al listado
                </a>
            </div>

            <section class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 bg-zinc-50 px-6 py-5 dark:border-zinc-800 dark:bg-zinc-950/40">
                    <span class="flex size-11 items-center justify-center rounded-full bg-[#c49a35]/20 text-sm font-bold text-[#9a761f] dark:text-[#e3c66d]">{{ $usuario->initials() }}</span>
                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">{{ $usuario->name }}</h2>
                        <p class="mt-1 text-sm text-zinc-500">{{ $usuario->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('administrativo.usuarios.update', $usuario) }}" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-5 sm:grid-cols-2">
                        <flux:input name="name" label="Usuario" :value="$usuario->name" required />
                        <flux:input name="email" type="email" label="Correo electrónico" :value="$usuario->email" required />
                        <flux:select name="role" label="Rol" required>
                            <option value="Profesor" @selected($usuario->effective_role === 'Profesor')>Profesor</option>
                            <option value="Estudiante" @selected($usuario->effective_role === 'Estudiante')>Estudiante</option>
                        </flux:select>
                        <flux:select name="status" label="Estado" required>
                            <option value="Activo" @selected(($usuario->status ?? $usuario->estado) === 'Activo')>Activo</option>
                            <option value="Inactivo" @selected(($usuario->status ?? $usuario->estado) === 'Inactivo')>Inactivo</option>
                        </flux:select>
                        <div class="sm:col-span-2">
                            <flux:input name="password" type="password" label="Nueva contraseña" placeholder="Dejar vacío para conservar la actual" />
                            <p class="mt-1.5 text-xs text-zinc-500">Solo diligénciala si deseas cambiar la contraseña.</p>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
                        <flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Cancelar</flux:button>
                        <flux:button variant="primary" icon="check" type="submit">Guardar cambios</flux:button>
                    </div>
                </form>
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
