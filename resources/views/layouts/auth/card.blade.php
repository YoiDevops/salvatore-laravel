<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-[#121212]">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-7xl flex-col gap-6">
                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-[#1e1f20] dark:border-[#3c4043] text-stone-800 dark:text-zinc-100 shadow-xs">
                        <div class="px-4 py-6 sm:px-10 sm:py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
