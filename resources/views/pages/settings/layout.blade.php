@php($esEstudiante = in_array(strtolower((string) auth()->user()?->effective_role), ['estudiante', '3'], true))

@if ($esEstudiante)
    <style>
        html:has(.student-settings),
        html:has(.student-settings) body,
        html:has(.student-settings) .institution-app-content,
        html:has(.student-settings) .institution-app-content > .min-w-0.flex-1 > [data-flux-main] {
            background: #f3edff !important;
            color: #3e2f55 !important;
        }

        html:has(.student-settings) [data-profile-scroll-header],
        html:has(.student-settings) .institution-app-content > [data-flux-header] {
            border-color: #d7c7f0 !important;
            background: #f3edff !important;
            color: #493769 !important;
        }

        html:has(.student-settings) .institution-sidebar {
            border-color: #d7c7f0 !important;
            background: #fffdf7 !important;
            color: #493769 !important;
        }

        html:has(.student-settings) .institution-sidebar :is(a, button, [data-flux-sidebar-group]) {
            color: #5b467d !important;
        }

        html:has(.student-settings) .institution-sidebar [aria-current="page"] {
            background: #eee5ff !important;
            color: #503477 !important;
        }

        html:has(.student-settings) .app-footer {
            border-color: #d7c7f0 !important;
            background: #ded0f5 !important;
            color: #493769 !important;
        }

        html:has(.student-settings) .relative.mb-8.overflow-hidden {
            border-color: #d7c7f0 !important;
            background: linear-gradient(135deg, #f3edff 0%, #eee5ff 55%, #e9defb 100%) !important;
            box-shadow: none !important;
        }

        html:has(.student-settings) .relative.mb-8.overflow-hidden > div:first-child {
            display: none;
        }

        .student-settings nav,
        .student-settings > div > section,
        .student-settings article {
            border-color: #d7c7f0 !important;
            background: #fffdf7 !important;
            box-shadow: 0 4px 14px rgba(95, 72, 139, .08) !important;
        }

        .student-settings :is(h1, h2, h3, [data-flux-heading]) {
            color: #3e2f55 !important;
        }

        .student-settings :is([data-flux-subheading], .text-zinc-500, .text-zinc-400) {
            color: #69518f !important;
        }

        .student-settings :is(dd, label, .text-zinc-800, .text-zinc-900) {
            color: #3e2f55 !important;
        }

        .student-settings nav :is(a, button) {
            color: #5b467d !important;
        }

        .student-settings nav [aria-current="page"] {
            border-color: #d7c7f0 !important;
            background: #eee5ff !important;
            color: #503477 !important;
        }

        .student-settings input:not([type="checkbox"]):not([type="radio"]) {
            border-color: #cbb9ea !important;
            background: #fff !important;
            color: #3e2f55 !important;
        }

        .student-settings input:focus {
            border-color: #a98ce3 !important;
            --tw-ring-color: #a98ce3 !important;
        }

        .student-settings button[type="submit"],
        .student-settings [data-flux-button][data-variant="primary"] {
            border-color: #a98ce3 !important;
            background: #69518f !important;
            color: #fff !important;
        }
    </style>
@endif

<div @class(['student-settings' => $esEstudiante, 'flex w-full min-w-0 items-start gap-6 max-md:flex-col'])>
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
