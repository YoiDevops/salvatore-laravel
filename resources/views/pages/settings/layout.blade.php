<div class="flex w-full min-w-0 items-start gap-6 max-md:flex-col">
    <nav aria-label="Secciones de configuración" class="w-full shrink-0 rounded-2xl border border-zinc-200 bg-white p-3 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20] md:w-[220px]">
        <p class="px-3 pb-2 pt-1 text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Tu cuenta</p>
        <flux:navlist>
            <flux:navlist.item icon="user-circle" :href="route('profile.edit')" :current="request()->routeIs('profile.edit')" wire:navigate>
                Mi perfil
            </flux:navlist.item>
            <flux:navlist.item icon="shield-check" :href="route('security.edit')" :current="request()->routeIs('security.edit')" wire:navigate>
                Seguridad
            </flux:navlist.item>
            <flux:navlist.item icon="sun" :href="route('appearance.edit')" :current="request()->routeIs('appearance.edit')" wire:navigate>
                Apariencia
            </flux:navlist.item>
        </flux:navlist>
    </nav>

    <div class="min-w-0 flex-1 self-stretch max-md:pt-2">
        <section class="w-full rounded-2xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20] sm:p-6 lg:p-8">
            <div class="border-b border-zinc-100 pb-5 dark:border-[#3c4043]">
                <flux:heading size="lg">{{ $heading ?? '' }}</flux:heading>
                <flux:subheading class="mt-1">{{ $subheading ?? '' }}</flux:subheading>
            </div>

            <div class="mt-6 w-full min-w-0">
                {{ $slot }}
            </div>
        </section>
    </div>
</div>
