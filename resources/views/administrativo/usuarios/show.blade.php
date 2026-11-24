@php($estado = $usuario->status ?? $usuario->estado ?? 'Sin estado')

<x-layouts::app.sidebar title="Detalle de cuenta">
    <flux:main>
        <div class="mx-auto max-w-3xl space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#c49a35]">Administración de cuentas</p>
                    <flux:heading size="xl" class="mt-2">Detalle de cuenta</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Consulta la información y el estado de acceso.</p>
                </div>
                <a href="{{ route('administrativo.usuarios.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-500 transition hover:text-[#9a761f]">
                    <flux:icon name="arrow-left" class="size-4" /> Volver al listado
                </a>
            </div>

            <section class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex flex-col gap-4 border-b border-zinc-200 bg-zinc-50 px-6 py-6 dark:border-zinc-800 dark:bg-zinc-950/40 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="flex size-16 shrink-0 items-center justify-center rounded-full bg-[#c49a35]/20 text-xl font-bold text-[#9a761f] dark:text-[#e3c66d]">{{ $usuario->initials() }}</span>
                        <div>
                            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">{{ $usuario->name }}</h2>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $usuario->email }}</p>
                        </div>
                    </div>
                    <span class="inline-flex w-fit items-center gap-2 rounded-full px-3 py-1.5 text-sm font-semibold {{ $estado === 'Activo' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300' : 'bg-red-500/10 text-red-700 dark:text-red-300' }}">
                        <span class="size-2 rounded-full {{ $estado === 'Activo' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                        {{ $estado }}
                    </span>
                </div>

                <dl class="grid gap-5 p-6 sm:grid-cols-2">
                    <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Usuario</dt>
                        <dd class="mt-2 font-medium text-zinc-900 dark:text-zinc-100">{{ $usuario->name }}</dd>
                    </div>
                    <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Correo electrónico</dt>
                        <dd class="mt-2 break-words font-medium text-zinc-900 dark:text-zinc-100">{{ $usuario->email }}</dd>
                    </div>
                    <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Rol asignado</dt>
                        <dd class="mt-2"><span class="inline-flex rounded-full bg-sky-500/10 px-2.5 py-1 text-xs font-semibold text-sky-700 dark:text-sky-300">{{ $usuario->effective_role }}</span></dd>
                    </div>
                    <div class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-800">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-zinc-500">Estado de acceso</dt>
                        <dd class="mt-2 font-medium text-zinc-900 dark:text-zinc-100">{{ $estado }}</dd>
                    </div>
                </dl>

                <div class="flex flex-col-reverse gap-3 border-t border-zinc-200 px-6 py-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
                    <flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Volver</flux:button>
                    <flux:button variant="primary" icon="pencil" href="{{ route('administrativo.usuarios.edit', $usuario) }}">Editar cuenta</flux:button>
                </div>
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
