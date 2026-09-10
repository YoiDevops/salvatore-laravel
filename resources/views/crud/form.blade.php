<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="max-w-2xl mx-auto">
            <flux:heading size="xl" class="mb-6">{{ $title }}</flux:heading>
            <form method="POST" action="{{ $action }}" class="space-y-4">
                @csrf
                @if($method)<input type="hidden" name="_method" value="{{ $method }}">@endif
                @foreach($fields as $field)
                    <flux:input :label="$field[1]" :name="$field[0]" :type="$field[2] ?? 'text'" :value="old($field[0], $item ? data_get($item, $field[0]) : '')" :required="$field[3] ?? false" />
                @endforeach
                <div class="flex justify-end gap-2"><flux:button variant="ghost" href="{{ route($resource.'.index') }}">Cancelar</flux:button><flux:button type="submit" variant="primary">Guardar</flux:button></div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
