<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main>
        <script>
        @if (strtolower((string) auth()->user()?->effective_role) === 'profesor')
            @php
                $decoracionesProfesor = [
                    'profesor.dashboard' => ['mano 1.png', 'pintura 1.png', 'mano 2.png', 'pintura 2.png', 'mano 3.png'],
                    'profesor.grados.*' => ['pintura 3.png', 'mano5.png', 'pintura 4.png', 'mano 1.png', 'pintura 5.png'],
                    'profesor.cursos.*' => ['mano 2.png', 'pintura 5.png', 'mano 3.png', 'pintura 1.png', 'mano5.png'],
                    'profesor.estudiantes.*' => ['pintura 2.png', 'mano 1.png', 'pintura 4.png', 'mano 2.png', 'pintura 3.png'],
                    'profesor.asignaturas.*' => ['mano 3.png', 'pintura 1.png', 'mano5.png', 'pintura 5.png', 'mano 1.png'],
                    'profesor.indicadores.*' => ['pintura 4.png', 'mano 2.png', 'pintura 2.png', 'mano 3.png', 'pintura 3.png'],
                    'profesor.escalas.*' => ['mano5.png', 'pintura 5.png', 'mano 1.png', 'pintura 3.png', 'mano 2.png'],
                ];
                $decoraciones = ['mano 1.png', 'pintura 1.png', 'mano 2.png', 'pintura 2.png', 'mano 3.png'];
                foreach ($decoracionesProfesor as $ruta => $imagenes) {
                    if (request()->routeIs($ruta)) {
                        $decoraciones = $imagenes;
                        break;
                    }
                }
            @endphp
            <div class="profesor-experience" style="position:relative;isolation:isolate;min-height:calc(100vh - 2rem);overflow:hidden;padding:1.25rem 0;">
                <div class="profesor-art" aria-hidden="true" style="position:absolute;inset:0;display:block;width:auto;pointer-events:none;">
                    @foreach ($decoraciones as $indice => $imagen)
                        <img loading="lazy" decoding="async" src="{{ asset('images/'.$imagen) }}" alt="" style="position:absolute;top:{{ [8, 27, 49, 70, 88][$indice] }}%;left:{{ [4, 27, 54, 76, 42][$indice] }}%;width:clamp(7rem,10vw,13rem);height:auto;">
                    @endforeach
                </div>
                <div class="profesor-page-content" style="position:relative;z-index:2;width:min(100% - 2rem,90rem);margin-inline:auto;">
                    {{ $slot }}
                </div>
            </div>
        @else
            {{ $slot }}
        @endif
    </flux:main>
    @if (strtolower((string) auth()->user()?->effective_role) === 'profesor')
        <script>
            (() => {
                const updateParallax = () => {
                    document.querySelectorAll('.profesor-art img').forEach((image) => {
                        const speed = image.closest('.profesor-art-right') ? 0.045 : -0.035;
                        image.style.transform = `translate3d(0, ${window.scrollY * speed}px, 0)`;
                    });
                };

                let frame = null;
                window.addEventListener('scroll', () => {
                    if (frame) return;
                    frame = window.requestAnimationFrame(() => {
                        updateParallax();
                        frame = null;
                    });
                }, { passive: true });
                updateParallax();
            })();
        </script>
    @endif
</x-layouts::app.sidebar>
