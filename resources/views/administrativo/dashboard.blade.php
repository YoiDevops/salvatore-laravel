<x-layouts::app.sidebar title="Panel del administrativo">
    <flux:main>
        <div class="mx-auto w-full max-w-6xl space-y-6">
            <div><p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión de usuarios</p><flux:heading size="xl" class="mt-2">Panel del administrativo</flux:heading><flux:subheading class="mt-1">Crea y administra las cuentas de profesores y estudiantes.</flux:subheading></div>
            <div class="grid gap-5 sm:grid-cols-3">
                @foreach ([['Usuarios registrados', $totalUsuarios, 'users'], ['Profesores', $totalProfesores, 'user-group'], ['Estudiantes', $totalEstudiantes, 'academic-cap']] as [$label, $total, $icon])
                    <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"><flux:icon :name="$icon" class="size-6 text-[#d8b85c]" /><p class="mt-5 text-3xl font-bold text-white">{{ $total }}</p><p class="mt-1 text-sm text-zinc-400">{{ $label }}</p></div>
                @endforeach
            </div>
            <section class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"><div class="flex items-center justify-between gap-4"><div><h2 class="font-semibold text-white">Crear en gestión institucional</h2><p class="mt-1 text-sm text-zinc-400">Usa los mismos formularios institucionales para profesores y estudiantes.</p></div><flux:button variant="primary" href="{{ route('administrativo.usuarios.index') }}">Ver cuentas</flux:button></div><div class="mt-6 grid gap-3 sm:grid-cols-2"><a href="{{ route('profesores.create') }}" class="rounded-xl border border-zinc-700 p-4 text-white transition hover:border-[#d8b85c]"><span class="font-semibold">Registrar profesor</span><p class="mt-1 text-sm text-zinc-400">Abrir el formulario completo de Gestión Institucional.</p></a><a href="{{ route('estudiantes.create') }}" class="rounded-xl border border-zinc-700 p-4 text-white transition hover:border-[#d8b85c]"><span class="font-semibold">Registrar estudiante</span><p class="mt-1 text-sm text-zinc-400">Abrir el formulario completo de Gestión Institucional.</p></a></div></section>
            <section class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"><h2 class="font-semibold text-white">Cuentas recientes</h2><div class="mt-4 divide-y divide-zinc-800">@forelse ($usuariosRecientes as $usuario)<div class="flex items-center justify-between py-3 text-sm"><span class="text-zinc-200">{{ $usuario->name }}</span><span class="text-zinc-500">{{ $usuario->effective_role }}</span></div>@empty<p class="py-3 text-sm text-zinc-500">No hay cuentas recientes.</p>@endforelse</div></section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
