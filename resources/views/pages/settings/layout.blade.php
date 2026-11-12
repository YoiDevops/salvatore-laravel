@php($esPerfilEstudiante = in_array(strtolower((string) auth()->user()?->effective_role), ['estudiante', '3'], true) && request()->routeIs('profile.edit', 'profile.student'))

@if ($esPerfilEstudiante)
    <style>
        html:has(.student-profile-settings),
        html:has(.student-profile-settings) body,
        html:has(.student-profile-settings) .institution-app-content,
        html:has(.student-profile-settings) .institution-app-content > .min-w-0.flex-1 > [data-flux-main] {
            background: #f3edff !important;
            color: #3e2f55 !important;
        }

        html:has(.student-profile-settings) [data-profile-scroll-header],
        html:has(.student-profile-settings) .institution-app-content > [data-flux-header],
        html:has(.student-profile-settings) .institution-app-content > .hidden {
            border-color: #d7c7f0 !important;
            background: #f3edff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .institution-sidebar {
            border-color: #cbb9ea !important;
            background: #f3edff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) [data-flux-sidebar] {
            border-color: #cbb9ea !important;
            background: #f3edff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-group] > button,
        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-group] > button span,
        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-group] > button svg {
            background: transparent !important;
            color: #5b467d !important;
        }

        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-item] {
            border-color: #cbb9ea !important;
            background: #ffffff !important;
            color: #5b467d !important;
        }

        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-item]:hover {
            border-color: #ad92dc !important;
            background: #e1d5f8 !important;
            color: #493769 !important;
            box-shadow: 0 3px 0 rgba(95, 72, 139, .1) !important;
        }

        html:has(.student-profile-settings) [data-flux-sidebar] [data-flux-sidebar-item][data-current] {
            border-color: #ad92dc !important;
            background: #e1d5f8 !important;
            color: #493769 !important;
            box-shadow: 0 3px 0 rgba(95, 72, 139, .1) !important;
        }

        /* Esta excepcion tiene mas especificidad que las reglas oscuras globales de .institution-sidebar. */
        html:has(.student-profile-settings) .student-profile-sidebar,
        html.dark:has(.student-profile-settings) .student-profile-sidebar {
            border-color: #cbb9ea !important;
            background: #f3edff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item],
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item] {
            border-color: #cbb9ea !important;
            background: #ffffff !important;
            color: #5b467d !important;
            box-shadow: none !important;
        }

        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item]:hover,
        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item][data-active],
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item]:hover,
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-item][data-active] {
            border-color: #ad92dc !important;
            background: #e1d5f8 !important;
            color: #493769 !important;
            box-shadow: 0 3px 0 rgba(95, 72, 139, .1) !important;
        }

        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-group] > div > div,
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-group] > div > div,
        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-brand],
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-brand],
        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-brand] > div:last-of-type,
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-brand] > div:last-of-type {
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-collapse],
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-collapse] {
            border-color: #cbb9ea !important;
            background: #ffffff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-collapse] button,
        html.dark:has(.student-profile-settings) .student-profile-sidebar [data-flux-sidebar-collapse] button {
            border-color: #cbb9ea !important;
            background: #ffffff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .app-footer {
            border-color: #d7c7f0 !important;
            background: #ded0f5 !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .app-footer-brand h3,
        html:has(.student-profile-settings) .app-footer-column h3,
        html:has(.student-profile-settings) .app-footer-brand p,
        html:has(.student-profile-settings) .app-footer-list li,
        html:has(.student-profile-settings) .app-footer-bottom {
            color: #493769 !important;
        }

        html:has(.student-profile-settings) .app-footer-logo {
            background: #c6afea !important;
            border-color: #a98ce3 !important;
            color: #503477 !important;
            box-shadow: 0 8px 16px rgba(80, 52, 119, .14) !important;
        }

        html:has(.student-profile-settings) .app-footer-socials a {
            border-color: transparent !important;
            box-shadow: 0 7px 0 rgba(73, 55, 105, .14) !important;
        }

        html:has(.student-profile-settings) .app-footer-socials a:nth-child(1) { background: #e9b4c5 !important; color: #71384d !important; }
        html:has(.student-profile-settings) .app-footer-socials a:nth-child(2) { background: #a9c8ef !important; color: #264c7d !important; }
        html:has(.student-profile-settings) .app-footer-socials a:nth-child(3) { background: #a9dabc !important; color: #246447 !important; }

        html:has(.student-profile-settings) .app-footer-socials a:hover {
            border-color: #ffffff !important;
            box-shadow: 0 9px 0 rgba(73, 55, 105, .16) !important;
        }

        html:has(.student-profile-settings) .relative.mb-8.overflow-hidden {
            border-color: #d7c7f0 !important;
            background: linear-gradient(135deg, #f3edff 0%, #eee5ff 55%, #e9defb 100%) !important;
            box-shadow: none !important;
        }

        html:has(.student-profile-settings) .relative.mb-8.overflow-hidden > div:first-child {
            display: none;
        }

        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] {
            border: 2px solid #d7c7f0 !important;
            background: #ffffff !important;
            color: #493769 !important;
            box-shadow: 0 4px 0 rgba(95, 72, 139, .12) !important;
        }

        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] > span:first-child {
            border: 1px solid #e5e7eb !important;
            background: #ffffff !important;
            color: #503477 !important;
            box-shadow: none !important;
            --tw-ring-color: #e5e7eb !important;
        }

        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] > div,
        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] > div span,
        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] > svg {
            border-color: transparent !important;
            background: transparent !important;
            color: #493769 !important;
            box-shadow: none !important;
        }

        html:has(.student-profile-settings) [data-test="sidebar-menu-button"] > span:first-child {
            border-color: #e5e7eb !important;
            background: #ffffff !important;
            color: #503477 !important;
        }

        html:has(.student-profile-settings) [data-test="sidebar-menu-button"]:hover {
            border-color: #d7c7f0 !important;
            background: #ffffff !important;
            box-shadow: 0 4px 0 rgba(95, 72, 139, .12) !important;
        }

        html:has(.student-profile-settings) [data-flux-menu] {
            border-color: #e5e7eb !important;
            background: #ffffff !important;
            color: #493769 !important;
        }

        html:has(.student-profile-settings) [data-flux-menu] * {
            color: #493769 !important;
        }

        html:has(.student-profile-settings) [data-flux-menu] span.rounded-full {
            border: 1px solid #e5e7eb !important;
            background: #ffffff !important;
            color: #503477 !important;
            box-shadow: none !important;
            --tw-ring-color: #e5e7eb !important;
        }

        html:has(.student-profile-settings) [data-flux-menu] [data-flux-menu-item]:hover,
        html:has(.student-profile-settings) [data-flux-menu] [data-flux-menu-item]:focus {
            background: #eee5ff !important;
            color: #35234f !important;
            box-shadow: 0 3px 0 rgba(95, 72, 139, .12) !important;
        }

        html:has(.student-profile-settings) [data-flux-menu] [data-flux-menu-item] {
            box-shadow: none !important;
        }

        .student-profile-settings nav,
        .student-profile-settings > div > section,
        .student-profile-settings article {
            border-color: #d7c7f0 !important;
            background: #fffdf7 !important;
            box-shadow: 0 4px 14px rgba(95, 72, 139, .08) !important;
        }

        .student-profile-settings :is(h1, h2, h3, [data-flux-heading]) {
            color: #3e2f55 !important;
        }

        .student-profile-settings :is([data-flux-subheading], .text-zinc-500, .text-zinc-400) {
            color: #69518f !important;
        }

        .student-profile-settings :is(dd, label, .text-zinc-800, .text-zinc-900) {
            color: #3e2f55 !important;
        }

        .student-profile-settings nav :is(a, button) {
            color: #5b467d !important;
        }

        .student-profile-settings nav [aria-current="page"] {
            border-color: #d7c7f0 !important;
            background: #eee5ff !important;
            color: #503477 !important;
        }

        .student-profile-settings input:not([type="checkbox"]):not([type="radio"]) {
            border-color: #cbb9ea !important;
            background: #fff !important;
            color: #3e2f55 !important;
        }

        .student-profile-settings input:focus {
            border-color: #a98ce3 !important;
            --tw-ring-color: #a98ce3 !important;
        }

        .student-profile-settings button[type="submit"],
        .student-profile-settings [data-flux-button][data-variant="primary"] {
            border-color: #a98ce3 !important;
            background: #69518f !important;
            color: #fff !important;
        }
    </style>
@endif

<div @class(['student-profile-settings' => $esPerfilEstudiante, 'flex w-full min-w-0 items-start gap-6 max-md:flex-col'])>
    <nav aria-label="Secciones de configuración" class="w-full shrink-0 rounded-2xl border border-zinc-200 bg-white p-3 shadow-sm dark:border-[#3c4043] dark:bg-[#1e1f20] md:w-[220px]">
        <p class="px-3 pb-2 pt-1 text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Tu cuenta</p>
        <flux:navlist>
            <flux:navlist.item icon="user-circle" :href="route($esPerfilEstudiante ? 'profile.student' : 'profile.edit')" :current="request()->routeIs($esPerfilEstudiante ? 'profile.student' : 'profile.edit')" wire:navigate>
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
