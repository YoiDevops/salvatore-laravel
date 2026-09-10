<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="max-w-2xl mx-auto space-y-4"><flux:heading size="xl">{{ $title }}</flux:heading><div class="border rounded-lg p-4 space-y-2">@foreach($columns as $column)<p><strong>{{ $column[1] }}:</strong> {{ data_get($item, $column[0]) ?? 'N/D' }}</p>@endforeach</div><flux:button href="{{ route($resource.'.index') }}">Volver</flux:button></div>
    </flux:main>
</x-layouts::app.sidebar>
