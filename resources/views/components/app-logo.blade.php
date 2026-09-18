@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white p-1 shadow-sm">
            <img src="{{ asset('images/LogoSv.png') }}" alt="Logo de la Institución Educativa Salvatore" class="size-full object-contain" />
        </x-slot>

        {{-- Usamos el slot "name" para inyectar el HTML de las dos líneas --}}
        <x-slot name="name">
            <div class="flex flex-col text-left leading-none">
                <span class="text-xs font-medium text-[#8b96a3] dark:text-zinc-400">Institución Educativa</span>
                <span class="text-base font-bold text-[#27313a] dark:text-white">Salvatore</span>
            </div>
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-9 items-center justify-center rounded-md bg-white p-1 shadow-sm">
            <img src="{{ asset('images/LogoSv.png') }}" alt="Logo de la Institución Educativa Salvatore" class="size-full object-contain" />
        </x-slot>

        <x-slot name="name">
            <div class="flex flex-col text-left leading-none">
                <span class="text-xs font-medium text-[#8b96a3] dark:text-zinc-400">Institución Educativa</span>
                <span class="text-base font-bold text-[#27313a] dark:text-white">Salvatore</span>
            </div>
        </x-slot>
    </flux:brand>
@endif