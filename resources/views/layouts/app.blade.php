<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        @if (strtolower((string) auth()->user()?->effective_role) === 'profesor')
            <div class="profesor-experience">
                <div class="profesor-page-content">
                    {{ $slot }}
                </div>
            </div>
        @else
            {{ $slot }}
        @endif
    </flux:main>
</x-layouts::app.sidebar>
