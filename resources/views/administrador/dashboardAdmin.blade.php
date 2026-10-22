<x-layouts::app title="Panel administrativo">
    <div class="mx-auto w-full max-w-[96rem] min-w-0 space-y-6 px-4 py-5 sm:space-y-8 sm:px-6 sm:py-8 lg:px-8">
        <div class="flex min-w-0 flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div class="min-w-0"><p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Administración escolar</p><flux:heading size="xl" class="mt-2">Panel administrativo</flux:heading><flux:subheading class="mt-1">Un espacio central para organizar la comunidad educativa.</flux:subheading></div>
            <div class="inline-flex w-fit max-w-full items-center gap-2 rounded-full border border-[#e6d6a8] bg-[#fffaf0] px-4 py-2 text-sm text-[#8a681b] dark:border-[#3c4043] dark:bg-[#292a2c] dark:text-[#e8eaed]"><span class="size-2 shrink-0 rounded-full bg-[#c49a35]"></span> Ciclo escolar en curso</div>
        </div>

        <div class="grid w-full gap-5 sm:grid-cols-2 xl:grid-cols-4">
            @foreach([['Comunidad escolar','Usuarios, roles y perfiles.','usuarios.index','users','bg-[#e8f2e8] text-[#2f6f48]'],['Equipo docente','Profesores y asignaturas.','profesores.index','user-group','bg-[#edf1fa] text-[#526da8]'],['Estructura academica','Grados, cursos y sedes.','cursos.index','building-library','bg-[#fbf1df] text-[#a46b21]'],['Evaluacion','Periodos y escalas de valoracion.','indicadores.index','chart-bar','bg-[#f5eaf2] text-[#985278]']] as [$title,$description,$routeName,$icon,$color])
                @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="group min-w-0 rounded-xl border border-[#d8dee8] bg-white p-4 shadow-md transition hover:-translate-y-0.5 hover:border-[#c49a35] hover:shadow-lg sm:p-6 dark:border-[#3c4043] dark:bg-[#1e1f20]"><div class="flex items-center justify-between"><span class="flex size-11 shrink-0 items-center justify-center rounded-xl {{ $color }}"><flux:icon :name="$icon" class="size-5" /></span><flux:icon name="arrow-up-right" class="size-4 text-zinc-400 transition group-hover:text-[#9a761f]" /></div><h2 class="mt-5 font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h2><p class="mt-1 text-sm leading-5 text-zinc-500 dark:text-zinc-400">{{ $description }}</p></a>@endif
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.35fr_0.65fr]">
            <section class="min-w-0 rounded-2xl border border-[#d8dee8] bg-white p-4 shadow-[0_8px_24px_rgba(16,33,59,0.07)] sm:p-6 dark:border-[#3c4043] dark:bg-[#1e1f20]"><div class="flex items-center justify-between gap-3"><div class="min-w-0"><h2 class="font-semibold">Gestión académica</h2><p class="mt-1 text-sm text-zinc-500">Accede a las áreas que sostienen el proceso formativo.</p></div><flux:icon name="academic-cap" class="size-6 shrink-0 text-[#9a761f]" /></div><div class="mt-6 grid gap-3 sm:grid-cols-2">
                @foreach([['Estudiantes','estudiantes.index','academic-cap'],['Profesores','profesores.index','user-group'],['Cursos','cursos.index','rectangle-stack'],['Asignaturas','asignaturas.index','book-open'],['Periodos','periodos.index','calendar-days'],['Escalas de valoracion','escalas.index','clipboard-document-list']] as [$label,$routeName,$icon])
                    @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="flex min-w-0 items-center gap-3 rounded-xl border border-zinc-100 px-3 py-3 text-sm font-medium text-zinc-700 transition hover:border-[#c49a35] hover:bg-[#fffaf0] sm:px-4 dark:border-[#3c4043] dark:text-zinc-300 dark:hover:bg-[#292a2c]"><span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-[#eef1f5] text-[#10213b] dark:bg-[#292a2c] dark:text-[#d8b85c]"><flux:icon :name="$icon" class="size-4" /></span><span class="min-w-0 break-words">{{ $label }}</span><flux:icon name="chevron-right" class="ml-auto size-4 shrink-0 text-zinc-400" /></a>@endif
                @endforeach
            </div></section>

            <section class="min-w-0 rounded-2xl border border-[#e6d6a8] bg-[#fffaf0] p-4 sm:p-6 dark:border-[#3c4043] dark:bg-[#1e1f20]"><div class="flex size-10 items-center justify-center rounded-xl bg-white text-[#9a761f] shadow-sm dark:bg-[#292a2c] dark:text-[#d8b85c]"><flux:icon name="sparkles" class="size-5" /></div><h2 class="mt-5 font-semibold text-[#5d4611] dark:text-[#e8eaed]">Organización institucional</h2><p class="mt-2 text-sm leading-6 text-[#7e6b3b] dark:text-[#bdc1c6]">Mantén actualizados los datos del colegio, sus sedes y los permisos de acceso.</p><div class="mt-6 space-y-2">
                @foreach([['Usuarios','usuarios.index'],['Roles','roles.index'],['Sedes','sedes.index']] as [$label,$routeName])
                    @if(Route::has($routeName))<a href="{{ route($routeName) }}" wire:navigate class="flex items-center justify-between gap-3 border-b border-[#e6d6a8] py-2 text-sm font-medium text-[#8a681b] last:border-0 dark:border-[#3c4043] dark:text-[#d8b85c]"><span>{{ $label }}</span><flux:icon name="arrow-up-right" class="size-4 shrink-0" /></a>@endif
                @endforeach
            </div></section>
        </div>
    </div>
</x-layouts::app>