<x-layouts::app.sidebar title="Solicitudes en espera">
    <flux:main>
        <div class="mx-auto max-w-[96rem] space-y-6">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión institucional</p>
                    <flux:heading size="xl" class="mt-2">Solicitudes en espera</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500">Revisa cada solicitud y decide si la apruebas o la deniegas.</p>
                </div>
            </div>

            @if (session('success'))
                <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/30 dark:text-emerald-200">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div role="alert" class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900 dark:border-amber-900/60 dark:bg-amber-950/30 dark:text-amber-200">
                    {{ session('warning') }}
                </div>
            @endif
            @error('solicitud')
                <div role="alert" class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900/60 dark:bg-red-950/30 dark:text-red-200">
                    {{ $message }}
                </div>
            @enderror

            @include('solicitudes._tablero', ['mostrarAcciones' => true])
        </div>
    </flux:main>
</x-layouts::app.sidebar>
