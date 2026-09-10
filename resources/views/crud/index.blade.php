<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="flex justify-between items-center mb-6">
            <flux:heading size="xl">{{ $title }}</flux:heading>
            <flux:button variant="primary" icon="plus" href="{{ route($resource.'.create') }}">Nuevo</flux:button>
        </div>
        <div class="overflow-x-auto border rounded-lg border-zinc-200 dark:border-zinc-700">
            <table class="w-full text-left text-sm">
                <thead><tr class="bg-zinc-100 dark:bg-zinc-800">@foreach($columns as $column)<th class="p-3">{{ $column[1] }}</th>@endforeach<th class="p-3 text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-t border-zinc-200 dark:border-zinc-700">
                            @foreach($columns as $column)<td class="p-3">{{ data_get($item, $column[0]) ?? 'N/D' }}</td>@endforeach
                            <td class="p-3 text-right space-x-2"><flux:button size="sm" href="{{ route($resource.'.show', $item->getKey()) }}">Ver</flux:button><flux:button size="sm" href="{{ route($resource.'.edit', $item->getKey()) }}">Editar</flux:button><form class="inline" method="POST" action="{{ route($resource.'.destroy', $item->getKey()) }}">@csrf @method('DELETE')<flux:button size="sm" variant="danger" type="submit">Eliminar</flux:button></form></td>
                        </tr>
                    @empty
                        <tr><td class="p-4 text-center" colspan="{{ count($columns) + 1 }}">No hay registros.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
