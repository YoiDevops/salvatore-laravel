<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="mx-auto w-full min-w-0 max-w-2xl space-y-4">
            <flux:heading size="xl" class="break-words">{{ $title }}</flux:heading>
            <x-action-help>Consulta los datos de esta ficha. Usa Volver para regresar al listado.</x-action-help>
            <div class="min-w-0 space-y-2 overflow-hidden rounded-lg border p-4">
                @foreach($columns as $column)
                    <p class="break-words"><strong>{{ $column[1] }}:</strong> {{ data_get($item, $column[0]) ?? 'N/D' }}</p>
                @endforeach
            </div>
            <flux:button class="w-full sm:w-auto" href="{{ route($resource.'.index') }}" aria-label="Volver al listado de registros">Volver</flux:button>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
