<flux:dropdown position="bottom" align="end">
    <button type="button" class="group flex items-center gap-2 rounded-full border border-zinc-200 bg-white/80 p-1.5 shadow-sm transition hover:border-[#d4af54] hover:bg-[#fffaf0] dark:border-zinc-700 dark:bg-zinc-900/80 dark:hover:border-[#d4af54] dark:hover:bg-[#1f2428]" data-test="sidebar-menu-button" aria-label="Perfil de usuario">
        <span class="flex size-9 items-center justify-center rounded-full bg-[#efe7d3] text-sm font-semibold text-[#7a5a14] ring-1 ring-[#d4af54] dark:bg-[#3d3522] dark:text-[#f4d688]">
            {{ auth()->user()->initials() }}
        </span>
        <div class="hidden sm:grid text-left leading-tight">
            <span class="truncate text-sm font-medium text-zinc-700 group-hover:text-zinc-900 dark:text-zinc-100 dark:group-hover:text-white">{{ auth()->user()->name }}</span>
        </div>
        <flux:icon name="chevrons-up-down" variant="micro" class="hidden size-4 text-zinc-400 group-hover:text-zinc-700 dark:text-zinc-300 sm:block" />
    </button>

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            <span class="flex size-10 items-center justify-center rounded-full bg-[#efe7d3] text-xs font-semibold text-[#7a5a14] ring-1 ring-[#d4af54] dark:bg-[#3d3522] dark:text-[#f4d688]">
                {{ auth()->user()->initials() }}
            </span>
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                {{ __('Settings') }}
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                    data-test="logout-button"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
