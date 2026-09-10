<x-layouts::app.sidebar :title="$title ?? 'Sistema Académico'">
    <flux:main>
        @if(session('success'))
            <flux:callout variant="success" class="mb-6">{{ session('success') }}</flux:callout>
        @endif

        @if($errors->any())
            <flux:callout variant="danger" class="mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </flux:callout>
        @endif

        <div class="academic-shell">
            @yield('content')
        </div>
    </flux:main>
</x-layouts::app.sidebar>
