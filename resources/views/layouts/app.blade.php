<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        @if (strtolower((string) auth()->user()?->effective_role) === 'profesor')
            <div class="profesor-experience min-h-[calc(100vh-2rem)] overflow-clip py-5">
                <div class="profesor-page-content mx-auto w-full max-w-[90rem] px-4">
                    {{ $slot }}
                </div>
            </div>
        @else
            {{ $slot }}
        @endif
    </flux:main>
</x-layouts::app.sidebar>
