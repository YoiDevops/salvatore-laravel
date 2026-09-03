<x-layouts::app :title="__('Panel de Administración')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div>
            <flux:heading size="xl">Panel de Administración</flux:heading>
            <flux:subheading>
                Bienvenido al sistema de administración de la Institución Salvatore.
            </flux:subheading>
        </div>

        <div class="grid auto-rows-min gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $tarjetas = [
                    ['icon' => 'users', 'title' => 'Gestionar Usuarios', 'desc' => 'Administrar los usuarios registrados en la plataforma.', 'route' => 'usuarios.index'],
                    ['icon' => 'shield-check', 'title' => 'Gestionar Roles', 'desc' => 'Configurar los roles y permisos del sistema.', 'route' => 'roles.index'],
                    ['icon' => 'identification', 'title' => 'Gestionar Profesores', 'desc' => 'Administrar usuarios con rol de profesor y su información.', 'route' => 'profesores.index'],
                    ['icon' => 'academic-cap', 'title' => 'Gestionar Estudiantes', 'desc' => 'Gestionar usuarios con rol de estudiante y su información.', 'route' => 'estudiantes.index'],
                    ['icon' => 'rectangle-stack', 'title' => 'Gestionar Cursos', 'desc' => 'Gestionar los cursos disponibles.', 'route' => 'cursos.index'],
                    ['icon' => 'book-open', 'title' => 'Gestionar Grados', 'desc' => 'Gestionar los grados disponibles.', 'route' => 'grados.index'],
                    ['icon' => 'book-open', 'title' => 'Gestionar Asignaturas', 'desc' => 'Gestionar las asignaturas y quién las dicta.', 'route' => 'asignaturas.index'],
                    ['icon' => 'clipboard-document-list', 'title' => 'Escalas de Valoración', 'desc' => 'Crear las escalas de valoración (números y letras) según lo establecido.', 'route' => 'escalas.index'],
                ];
            @endphp

            @foreach ($tarjetas as $tarjeta)
                @if (Route::has($tarjeta['route']))
                    <a
                        href="{{ route($tarjeta['route']) }}"
                        wire:navigate
                        class="group flex flex-col gap-2 rounded-xl border border-neutral-200 p-5 transition hover:border-neutral-300 hover:shadow-sm dark:border-neutral-700 dark:hover:border-neutral-600"
                    >
                        <flux:icon :name="$tarjeta['icon']" class="size-6 text-zinc-500 dark:text-zinc-400" />
                        <flux:heading size="lg">{{ $tarjeta['title'] }}</flux:heading>
                        <flux:text class="text-zinc-500 dark:text-zinc-400">{{ $tarjeta['desc'] }}</flux:text>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts::app>
