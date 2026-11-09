<x-layouts::app title="Mi rincón escolar">
    @php
        $coloresMaterias = [
            ['fondo' => '#fff3bf', 'borde' => '#e8b83f', 'texto' => '#614900', 'icono' => '✏️'],
            ['fondo' => '#d8f3e9', 'borde' => '#5dbb9b', 'texto' => '#155b4e', 'icono' => '🌿'],
            ['fondo' => '#eadfff', 'borde' => '#a98ce3', 'texto' => '#503477', 'icono' => '🎨'],
            ['fondo' => '#ffe0dc', 'borde' => '#e9948b', 'texto' => '#7c3733', 'icono' => '🔢'],
        ];
    @endphp

    @include('estudiante.headbar-estudiante')

    <style>
        html:has(.student-board) body,
        html:has(.student-board) .institution-app-content,
        html:has(.student-board) .institution-app-content > [data-flux-main] {
            background: #f3edff !important;
            color: #3e2f55 !important;
        }

        html:has(.student-board) .app-footer {
            background: #ded0f5 !important;
            border-color: #d7c7f0 !important;
            color: #493769 !important;
        }

        html:has(.student-board) .app-footer-brand h3,
        html:has(.student-board) .app-footer-column h3,
        html:has(.student-board) .app-footer-brand p,
        html:has(.student-board) .app-footer-list li,
        html:has(.student-board) .app-footer-bottom {
            color: #493769 !important;
        }

        html:has(.student-board) .app-footer-logo {
            background: #c6afea !important;
            border-color: #a98ce3 !important;
            color: #503477 !important;
            box-shadow: 0 8px 16px rgba(80, 52, 119, .14) !important;
        }

        html:has(.student-board) .app-footer-socials a {
            border-color: transparent !important;
            box-shadow: 0 7px 0 rgba(73, 55, 105, .14) !important;
        }

        html:has(.student-board) .app-footer-socials a:nth-child(1) { background: #e9b4c5 !important; color: #71384d !important; }
        html:has(.student-board) .app-footer-socials a:nth-child(2) { background: #a9c8ef !important; color: #264c7d !important; }
        html:has(.student-board) .app-footer-socials a:nth-child(3) { background: #a9dabc !important; color: #246447 !important; }

        html:has(.student-board) .app-footer-socials a:hover {
            border-color: #ffffff !important;
            box-shadow: 0 9px 0 rgba(73, 55, 105, .16) !important;
        }

        html:has(.student-board) .student-headbar {
            position: sticky !important;
            top: 0 !important;
            z-index: 50;
            width: 100vw;
            max-width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-top: 0 !important;
            border-bottom: 0;
            background: #ffffff;
            box-shadow: none;
        }

        html:has(.student-board) .institution-app-content {
            position: relative;
        }

        html:has(.student-board) .institution-app-content > [data-flux-main] {
            padding-top: 0 !important;
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        html:has(.student-board) .student-headbar::after {
            position: absolute;
            z-index: -1;
            right: 0;
            bottom: -2rem;
            left: 0;
            height: 3rem;
            content: '';
            background: #ffffff;
            clip-path: ellipse(76% 100% at 50% 0%);
            pointer-events: none;
        }

        html:has(.student-board) .student-headbar-inner {
            position: relative;
            z-index: 1;
        }

        /* En el portal infantil, la navegación se convierte en una cabecera horizontal. */
        .student-board {
            position: relative;
            isolation: isolate;
            min-height: 100%;
            overflow: visible;
            padding-top: 0;
            background: #f3edff;
            color: #3e2f55;
            font-family: 'Nunito', 'Comic Sans MS', ui-rounded, system-ui, sans-serif;
        }

        .student-board::before,
        .student-board::after {
            position: absolute;
            
            z-index: 0;
            content: '';
            pointer-events: none;
            border-radius: 999px;
        }

        .student-board::before {
            top: 7rem;
            right: -8rem;
            width: 26rem;
            height: 26rem;
            background: #c9b5eb;
            box-shadow: -38rem 31rem 0 2rem #b8dfd0;
            opacity: .7;
        }

        .student-board::after {
            bottom: -8rem;
            left: 12%;
            width: 18rem;
            height: 18rem;
            background: #e8cd79;
            opacity: .7;
        }

        .student-doodles {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .student-doodles span { position: absolute; color: #8062ad; font-size: 2rem; opacity: .65; }
        .student-doodles span:nth-child(1) { top: 8%; left: 7%; color: #a76fc4; transform: rotate(-18deg); }
        .student-doodles span:nth-child(2) { top: 28%; right: 8%; color: #4f9e91; transform: rotate(15deg); }
        .student-doodles span:nth-child(3) { top: 56%; left: 5%; color: #d39e3a; transform: rotate(14deg); }
        .student-doodles span:nth-child(4) { bottom: 12%; right: 12%; color: #c66d76; transform: rotate(-12deg); }
        .student-doodles span:nth-child(5) { top: 45%; left: 48%; color: #8062ad; opacity: .55; }

        .student-board > .relative {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .student-board > .relative > * {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .student-board > .relative > section.grid {
            gap: 2.5rem !important;
        }

        .student-subject-grid {
            gap: 1.75rem !important;
        }

        .student-panel {
            position: relative;
            z-index: 2;
            border: 2px solid #d7c7f0;
            border-radius: 1rem 2.75rem 1rem 2.75rem;
            box-shadow: 5px 5px 0 rgba(95, 72, 139, .12);
        }

        .student-image-container {
            position: relative;
            width: 100%;
            max-width: 72rem;
            flex: 0 1 72rem;
            margin-inline: auto;
            aspect-ratio: auto;
            height: auto;
            min-height: clamp(20rem, 23vw, 22rem);
            display: flex;
            align-items: center;
            isolation: isolate;
            background: linear-gradient(135deg, #fbf9ff 0%, #eee5ff 100%);
            border: 2px solid #d7c7f0;
            border-radius: 0 0 2.75rem 2.75rem;
            box-shadow: 5px 5px 0 rgba(95, 72, 139, .12);
        }

        .student-image-content {
            display: flex;
            width: 100%;
            max-width: 60rem;
            flex-direction: column;
            align-items: center;
            margin-inline: auto;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .student-panel-small {
            border-radius: .8rem 1.8rem .8rem 1.8rem;
            box-shadow: 3px 3px 0 rgba(95, 72, 139, .1);
        }

        .student-subject { transition: transform .2s ease, box-shadow .2s ease; }
        .student-subject:hover { transform: translateY(-3px) rotate(1deg); box-shadow: 5px 7px 0 rgba(95, 72, 139, .16); }

        @media (prefers-reduced-motion: reduce) { .student-subject { transition: none; } }
    </style>

    <div class="student-board px-3 py-5 sm:px-6 sm:py-8">
        <div class="student-doodles" aria-hidden="true"><span>✦</span><span>✎</span><span>✿</span><span>★</span><span>• • •</span></div>

        <div class="relative mx-auto max-w-6xl space-y-10">
            <section class="student-image-container overflow-hidden p-7 sm:p-10">
                <div class="student-image-content max-w-3xl">
                    <p class="text-sm font-black uppercase tracking-[.18em] text-[#69518f]">Mi rinc&oacute;n escolar</p>
                    <h1 class="mt-4 text-4xl font-black leading-tight tracking-tight text-[#3e2f55] sm:text-6xl">&iexcl;Hola, {{ $estudiante?->nombres_estudiante ?? auth()->user()->name }}!</h1>
                    <p class="mt-4 max-w-2xl text-lg font-bold leading-7 text-[#5e4a78] sm:text-xl">Aqu&iacute; puedes mirar tu curso, tus materias y tus notas.</p>
                    <div class="mt-7 inline-flex items-center gap-3 rounded-xl border-2 border-[#b6a0e0] bg-[#f8f4ff] px-4 py-3 font-black text-[#503b70] shadow-[4px_4px_0_#b6a0e0]">
                        <span class="text-2xl">🌟</span>
                        <span>Un lugar para aprender y crecer</span>
                    </div>
                </div>
            </section>

            @if (! $estudiante)
                <section class="student-panel bg-[#fff9df] p-8 text-center">
                    <div class="text-5xl">🧩</div>
                    <h2 class="mt-3 text-2xl font-black text-[#614900]">Falta una pieza</h2>
                    <p class="mx-auto mt-2 max-w-lg font-semibold leading-6 text-[#806c2f]">Tu usuario est&aacute; listo, pero no hay una ficha de estudiante relacionada en la base de datos.</p>
                </section>
            @else
                <section class="grid gap-10 lg:grid-cols-[1.25fr_.75fr]">
                    <article class="student-panel bg-[#e0f7ef] p-6 sm:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div><p class="text-sm font-black uppercase tracking-[.16em] text-[#287b69]">Mi curso</p><h2 class="mt-2 text-3xl font-black text-[#164e43] sm:text-4xl">{{ $estudiante->curso?->nombre_curso ?? 'Sin curso registrado' }}</h2></div>
                            <span class="text-5xl">🎒</span>
                        </div>
                        <div class="mt-7 grid gap-3 sm:grid-cols-2">
                            <div class="student-panel-small border border-[#a7dfce] bg-[#f7fffc] p-4"><p class="text-xs font-black uppercase text-[#579787]">Grado</p><p class="mt-2 font-black text-[#164e43]">{{ $estudiante->curso?->grado?->nombre_grado ?? 'Sin registrar' }}</p></div>
                            <div class="student-panel-small border border-[#a7dfce] bg-[#f7fffc] p-4"><p class="text-xs font-black uppercase text-[#579787]">Jornada</p><p class="mt-2 font-black text-[#164e43]">{{ $estudiante->curso?->jornada ?? 'Sin registrar' }}</p></div>
                            <div class="student-panel-small border border-[#a7dfce] bg-[#f7fffc] p-4"><p class="text-xs font-black uppercase text-[#579787]">A&ntilde;o lectivo</p><p class="mt-2 font-black text-[#164e43]">{{ $estudiante->curso?->ano_lectivo ?? 'Sin registrar' }}</p></div>
                            <div class="student-panel-small border border-[#a7dfce] bg-[#f7fffc] p-4"><p class="text-xs font-black uppercase text-[#579787]">Sede</p><p class="mt-2 font-black text-[#164e43]">{{ $estudiante->curso?->sede?->nombre_sede ?? 'Sin registrar' }}</p></div>
                        </div>
                    </article>

                    <article class="student-panel bg-[#ffe6e1] p-6 sm:p-8">
                        <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-black uppercase tracking-[.16em] text-[#a4544b]">Mi profesor</p><h2 class="mt-3 text-2xl font-black leading-tight text-[#713934]">A&uacute;n no est&aacute; registrado</h2></div><span class="text-5xl">🧑‍🏫</span></div>
                        <p class="mt-7 font-semibold leading-6 text-[#895c57]">Cuando exista una asignaci&oacute;n en la base de datos, aqu&iacute; aparecer&aacute; el nombre de tu profesor.</p>
                    </article>
                </section>
            @endif

            <section class="student-panel bg-[#fffdf7] p-6 sm:p-8">
                <div class="flex flex-wrap items-end justify-between gap-4 border-b-2 border-dashed border-[#d7c7f0] pb-5">
                    <div><p class="text-sm font-black uppercase tracking-[.18em] text-[#7959aa]">Lo que estoy aprendiendo</p><h2 class="mt-2 text-3xl font-black text-[#3e2f55] sm:text-4xl">Mis materias</h2></div>
                    <span class="text-5xl">📚</span>
                </div>
                <div class="student-subject-grid mt-6 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($asignaturas as $indice => $asignatura)
                        @php($color = $coloresMaterias[$indice % count($coloresMaterias)])
                        <article class="student-subject student-panel-small border-2 p-5" style="background: {{ $color['fondo'] }}; border-color: {{ $color['borde'] }}">
                            <div class="flex items-start justify-between gap-3"><span class="flex size-12 items-center justify-center rounded-xl bg-white/75 text-2xl">{{ $color['icono'] }}</span><span class="rounded-lg bg-white/75 px-2 py-1 text-[11px] font-black" style="color: {{ $color['texto'] }}">MATERIA</span></div>
                            <h3 class="mt-5 text-xl font-black" style="color: {{ $color['texto'] }}">{{ $asignatura->nombre_asignatura }}</h3>
                            @if ($asignatura->area?->nombre_area)<p class="mt-2 text-sm font-bold opacity-80" style="color: {{ $color['texto'] }}">&Aacute;rea: {{ $asignatura->area->nombre_area }}</p>@endif
                            <p class="mt-4 text-xs font-black opacity-70" style="color: {{ $color['texto'] }}">{{ $asignatura->intensidad_horaria }} horas</p>
                        </article>
                    @empty
                        <p class="rounded-xl bg-[#f3edff] p-5 font-semibold text-[#69518f] sm:col-span-2 lg:col-span-3">A&uacute;n no hay materias registradas.</p>
                    @endforelse
                </div>
            </section>

            <section class="student-panel bg-[#fff2bd] p-6 sm:p-8">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div><p class="text-sm font-black uppercase tracking-[.18em] text-[#987019]">Mi progreso</p><h2 class="mt-2 text-3xl font-black text-[#614900]">Mis notas</h2><p class="mt-3 max-w-2xl font-semibold leading-6 text-[#806c2f]">Todav&iacute;a no hay notas registradas para mostrar. Cuando existan, aparecer&aacute;n aqu&iacute;.</p></div>
                    <div class="student-panel-small flex items-center gap-1 bg-[#fff9df] px-5 py-4 text-4xl text-[#d5a928]" aria-label="Sin notas registradas"><span class="opacity-40">★</span><span class="opacity-40">★</span><span class="opacity-40">★</span></div>
                </div>
            </section>

            <p class="pb-3 text-center text-sm font-black text-[#69518f]">✦ Aprender es descubrir algo nuevo cada d&iacute;a ✦</p>
        </div>
    </div>
</x-layouts::app>
