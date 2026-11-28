<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="academic-shell">
        <div class="mb-6 flex min-w-0 flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
                <flux:heading size="xl" class="break-words">{{ $title }}</flux:heading>
            </div>
            <flux:button
                class="w-full shrink-0 sm:w-auto"
                variant="primary"
                icon="plus"
                href="{{ route($resource.'.create') }}"
                aria-label="Crear un nuevo registro de {{ mb_strtolower($title) }}"
            >
                Nuevo
            </flux:button>
        </div>
        @include('components.search-filters', [
            'placeholder' => 'Buscar en '.mb_strtolower($title).'...',
            'filterLabel' => $filterLabel ?? 'Filtrar por',
            'filterOptions' => $filterOptions ?? [],
        ])
        <div class="academic-table-wrap overflow-x-auto rounded-lg border shadow-sm" role="region" aria-label="Listado de registros; desliza horizontalmente para ver más columnas" tabindex="0">
            <p class="mb-2 px-3 pt-3 text-xs text-zinc-500 lg:hidden dark:text-zinc-400">Desliza la tabla hacia los lados para ver todas las columnas.</p>
            <table class="academic-table w-full text-left text-sm">
                <thead><tr>@foreach($columns as $column)<th class="p-3">{{ $column[1] }}</th>@endforeach<th class="p-3 text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-t">
                            @foreach($columns as $column)<td class="p-3">{{ data_get($item, $column[0]) ?? 'N/D' }}</td>@endforeach
                            <td class="p-3">
                                <div class="flex flex-wrap items-center justify-end gap-2">
                                    <flux:button class="crud-action-button" size="sm" href="{{ route($resource.'.show', $item->getKey()) }}" aria-label="Ver registro {{ $item->getKey() }}">Ver</flux:button>
                                    <flux:button class="crud-action-button" size="sm" href="{{ route($resource.'.edit', $item->getKey()) }}" aria-label="Editar registro {{ $item->getKey() }}">Editar</flux:button>
                                    <form class="inline-flex" method="POST" action="{{ route($resource.'.destroy', $item->getKey()) }}">@csrf @method('DELETE')<flux:button class="crud-action-button-danger" size="sm" variant="danger" type="submit" aria-label="Eliminar registro {{ $item->getKey() }}">Eliminar</flux:button></form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-4 text-center" colspan="{{ count($columns) + 1 }}">No hay registros.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
