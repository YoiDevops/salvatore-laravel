@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Institución Educativa Salvatore" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white p-1 shadow-sm">
            <img src="{{ asset('images/LogoSv.png') }}" alt="Logo de la Institución Educativa Salvatore" class="size-full object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Institución Educativa Salvatore" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white p-1 shadow-sm">
            <img src="{{ asset('images/LogoSv.png') }}" alt="Logo de la Institución Educativa Salvatore" class="size-full object-contain" />
        </x-slot>
    </flux:brand>
@endif
