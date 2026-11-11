<x-layouts::app.sidebar title="Crear cuenta">
    <flux:main>
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#c49a35]">Administración de cuentas</p>
                    <flux:heading size="xl" class="mt-2">Crear cuenta</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Registra un nuevo acceso para un profesor o estudiante.</p>
                </div>
                <a href="{{ route('administrativo.usuarios.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-500 transition hover:text-[#9a761f]">
                    <flux:icon name="arrow-left" class="size-4" /> Volver al listado
                </a>
            </div>

            <section class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 bg-zinc-50 px-6 py-5 dark:border-zinc-800 dark:bg-zinc-950/40">
                    <div class="flex items-center gap-3">
                        <span class="rounded-xl bg-[#c49a35]/15 p-2.5 text-[#c49a35]"><flux:icon name="user-plus" class="size-5" /></span>
                        <div>
                            <h2 class="font-semibold text-zinc-900 dark:text-white">Información de acceso</h2>
                            <p class="mt-1 text-sm text-zinc-500">Completa los datos básicos de la cuenta.</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('administrativo.usuarios.store') }}" class="space-y-6 p-6">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <flux:input name="name" label="Usuario" placeholder="Ej. maria.gomez" required />
                        <flux:input name="email" type="email" label="Correo electrónico" placeholder="correo@institucion.edu.co" required />
                        <flux:select name="role" label="Rol" required>
                            <option value="">Seleccione un rol</option>
                            <option value="Profesor" @selected($rolInicial === 'Profesor')>Profesor</option>
                            <option value="Estudiante" @selected($rolInicial === 'Estudiante')>Estudiante</option>
                        </flux:select>
                        <flux:select name="status" label="Estado" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </flux:select>
                        <div class="sm:col-span-2">
                            <flux:input name="password" type="password" label="Contraseña" placeholder="Mínimo 6 caracteres" required />
                            <p class="mt-1.5 text-xs text-zinc-500">La contraseña debe tener al menos 6 caracteres.</p>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
                        <flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Cancelar</flux:button>
                        <flux:button variant="primary" icon="check" type="submit">Guardar cuenta</flux:button>
                    </div>
                </form>
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
