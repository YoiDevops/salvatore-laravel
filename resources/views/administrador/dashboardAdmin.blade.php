<x-layouts::app title="Panel administrativo">
    <div class="mx-auto max-w-7xl space-y-8">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div><p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Administración escolar</p><flux:heading size="xl" class="mt-2">Panel administrativo</flux:heading><flux:subheading class="mt-1">Un espacio central para organizar la comunidad educativa.</flux:subheading></div>
            <div class="flex items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#665322] dark:bg-[#2e2714] dark:text-[#d8b85c]"><span class="size-2 rounded-full bg-[#c49a35]"></span> Ciclo escolar en curso</div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([['Comunidad escolar','Usuarios, roles y perfiles.','usuarios.index','users','bg-[#e8f2e8] text-[#2f6f48]'],['Equipo docente','Profesores y asignaturas.','profesores.index','user-group','bg-[#edf1fa] text-[#526da8]'],['Estructura academica','Grados, cursos y sedes.','cursos.index','building-library','bg-[#fbf1df] text-[#a46b21]'],['Evaluacion','Periodos y escalas de valoracion.','indicadores.index','chart-bar','bg-[#f5eaf2] text-[#985278]']] as [$title,$description,$routeName,$icon,$color])
                @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="group rounded-2xl border border-[#d8dee8] bg-white p-5 shadow-[0_8px_24px_rgba(16,33,59,0.07)] transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900"><div class="flex items-center justify-between"><span class="flex size-11 items-center justify-center rounded-xl {{ $color }}"><flux:icon :name="$icon" class="size-5" /></span><flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" /></div><h2 class="mt-5 font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h2><p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">{{ $description }}</p></a>@endif
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
            <section class="rounded-2xl border border-[#d8dee8] bg-white p-6 shadow-[0_8px_24px_rgba(16,33,59,0.07)] dark:border-zinc-800 dark:bg-zinc-900"><div class="flex items-center justify-between"><div><h2 class="font-semibold">Gestión académica</h2><p class="mt-1 text-sm text-zinc-500">Accede a las áreas que sostienen el proceso formativo.</p></div><flux:icon name="academic-cap" class="size-6 text-[#9a761f]" /></div><div class="mt-6 grid gap-3 sm:grid-cols-2">
                @foreach([['Estudiantes','estudiantes.index','academic-cap'],['Profesores','profesores.index','user-group'],['Cursos','cursos.index','rectangle-stack'],['Asignaturas','asignaturas.index','book-open'],['Periodos','periodos.index','calendar-days'],['Escalas de valoracion','escalas.index','clipboard-document-list']] as [$label,$routeName,$icon])
                    @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="flex items-center gap-3 rounded-xl border border-zinc-100 px-4 py-3 text-sm font-medium text-zinc-700 transition hover:border-[#c49a35] hover:bg-[#fffaf0] dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800"><span class="flex size-8 items-center justify-center rounded-lg bg-[#eef1f5] text-[#10213b] dark:bg-[#253653] dark:text-[#d8b85c]"><flux:icon :name="$icon" class="size-4" /></span>{{ $label }}<flux:icon name="chevron-right" class="ml-auto size-4 text-zinc-400" /></a>@endif
                @endforeach
            </div></section>

            <section class="rounded-2xl border border-[#e6d6a8] bg-[#fffaf0] p-6 dark:border-[#665322] dark:bg-[#2e2714]"><div class="flex size-10 items-center justify-center rounded-xl bg-white text-[#9a761f] shadow-sm dark:bg-[#443a1c] dark:text-[#d8b85c]"><flux:icon name="sparkles" class="size-5" /></div><h2 class="mt-5 font-semibold text-[#5d4611] dark:text-[#f0d98b]">Organización institucional</h2><p class="mt-2 text-sm leading-6 text-[#7e6b3b] dark:text-[#d8c78d]">Mantén actualizados los datos del colegio, sus sedes y los permisos de acceso.</p><div class="mt-6 space-y-2">
                @foreach([['Usuarios','usuarios.index'],['Roles','roles.index'],['Instituciones','instituciones.index'],['Sedes','sedes.index']] as [$label,$routeName])
                    @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="flex items-center justify-between border-b border-[#e6d6a8] py-2 text-sm font-medium text-[#8a681b] last:border-0 dark:border-[#665322] dark:text-[#d8b85c]"><span>{{ $label }}</span><flux:icon name="arrow-up-right" class="size-4" /></a>@endif
                @endforeach
            </div></section>
        </div>
    </div>
</x-layouts::app>