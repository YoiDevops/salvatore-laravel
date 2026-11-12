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

            @include('solicitudes._tablero', ['mostrarAcciones' => true])
        </div>
    </flux:main>
</x-layouts::app.sidebar>
