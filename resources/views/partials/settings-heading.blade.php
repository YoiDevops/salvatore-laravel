@php($esEstudiante = in_array(strtolower((string) auth()->user()?->effective_role), ['estudiante', '3'], true))

<div class="relative mb-8 overflow-hidden rounded-3xl border p-5 shadow-sm sm:p-7 {{ $esEstudiante ? 'border-[#d7c7f0] bg-gradient-to-br from-[#f3edff] via-[#eee5ff] to-[#e9defb]' : 'border-[#e7dfca] bg-gradient-to-br from-[#fffdf7] via-white to-[#f7f3e8] dark:border-[#3c4043] dark:from-[#1e1f20] dark:via-[#1e1f20] dark:to-[#252321]' }}">
    <div class="pointer-events-none absolute -right-12 -top-16 size-48 rounded-full bg-[#d8b85c]/10 blur-2xl" aria-hidden="true"></div>
    <div class="relative flex items-start gap-4">
        <span class="flex size-12 shrink-0 items-center justify-center rounded-2xl shadow-sm ring-1 {{ $esEstudiante ? 'bg-[#e1d5f8] text-[#503477] ring-[#cbb9ea]' : 'bg-white text-[#9a761f] ring-[#e7dfca] dark:bg-[#292a2c] dark:text-[#d8b85c] dark:ring-[#3c4043]' }}">
            <flux:icon name="adjustments-horizontal" class="size-6" />
        </span>
        <div class="min-w-0">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] {{ $esEstudiante ? 'text-[#7959aa]' : 'text-[#9a761f] dark:text-[#d8b85c]' }}">Centro de cuenta</p>
            <flux:heading size="xl" level="1" class="mt-1 {{ $esEstudiante ? '!text-[#3e2f55]' : '' }}">Configuración</flux:heading>
            <flux:subheading size="lg" class="mt-1 {{ $esEstudiante ? '!text-[#5e4a78]' : '' }}">Administra tu perfil, la seguridad y la apariencia del sistema.</flux:subheading>
        </div>
    </div>
</div>
