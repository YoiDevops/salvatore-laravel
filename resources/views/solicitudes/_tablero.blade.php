@php
    $estadoTexto = ['en espera' => 'En espera', 'aprobado' => 'Aprobado', 'denegado' => 'Denegado'];
    $estadoClases = [
        'en espera' => 'bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-300',
        'aprobado' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300',
        'denegado' => 'bg-red-100 text-red-800 dark:bg-red-950/50 dark:text-red-300',
    ];
    $valor = fn ($value) => filled($value) ? $value : 'No registrado';
@endphp

<section class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
    <div class="flex items-center justify-between gap-3">
        <h2 class="font-semibold">Solicitudes</h2>
        @if (($estadoFiltro ?? null) && $estadoFiltro !== 'todos')
            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClases[$estadoFiltro] ?? 'bg-zinc-100 text-zinc-700' }}">
                {{ $estadoTexto[$estadoFiltro] ?? ucfirst($estadoFiltro) }}
            </span>
        @endif
    </div>

    <div class="mt-4 overflow-x-auto">
        <table class="w-full min-w-[620px] text-left text-sm">
            <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500 dark:border-zinc-800">
                <tr>
                    <th class="p-3">Documento</th>
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Género</th>
                    @if ($mostrarAcciones)
                        <th class="p-3"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($solicitudes as $s)
                    @php($modalId = 'solicitud-detalle-'.$s->getKey())
                    <tr
                        class="cursor-pointer border-b border-zinc-100 transition hover:bg-zinc-50 dark:border-zinc-800 dark:hover:bg-zinc-800/60"
                        role="button"
                        tabindex="0"
                        title="Ver detalles de la solicitud"
                        onclick="document.getElementById('{{ $modalId }}').showModal()"
                        onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); document.getElementById('{{ $modalId }}').showModal(); }"
                    >
                        <td class="p-3 font-medium">{{ $s->estudiante_tipo_documento }} {{ $s->estudiante_numero_documento }}</td>
                        <td class="p-3">{{ $s->estudiante_nombres }} {{ $s->estudiante_apellidos }}</td>
                        <td class="p-3">{{ $s->estudiante_genero }}</td>
                        @if ($mostrarAcciones)
                            <td class="p-3 text-right" onclick="event.stopPropagation()">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <form method="POST" action="{{ route('administrativo.solicitudes.estado', $s) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="estado" value="aprobado">
                                        <button type="submit" class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">Aceptar</button>
                                    </form>
                                    <form method="POST" action="{{ route('administrativo.solicitudes.estado', $s) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="estado" value="denegado">
                                        <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-700">Denegar</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $mostrarAcciones ? 4 : 3 }}" class="p-6 text-center text-zinc-500">No hay solicitudes en esta categoría.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $solicitudes->links() }}
</section>

@foreach($solicitudes as $s)
    @php($modalId = 'solicitud-detalle-'.$s->getKey())
    <dialog id="{{ $modalId }}" class="m-auto max-h-[90vh] w-[min(58rem,calc(100vw-2rem))] max-w-none rounded-2xl border border-zinc-200 bg-white p-0 text-zinc-900 shadow-2xl backdrop:bg-zinc-950/70 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100">
        <div class="flex max-h-[90vh] flex-col">
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#9a761f]">Detalle de solicitud</p>
                    <h2 class="mt-1 text-lg font-semibold">{{ $s->estudiante_nombres }} {{ $s->estudiante_apellidos }}</h2>
                </div>
                <button type="button" class="rounded-lg p-2 text-xl leading-none text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-800 dark:hover:text-zinc-100" onclick="document.getElementById('{{ $modalId }}').close()" aria-label="Cerrar ventana">&times;</button>
            </div>

            <div class="overflow-y-auto px-5 py-5">
                <div class="grid gap-5 lg:grid-cols-2">
                    <section>
                        <h3 class="mb-3 text-sm font-semibold">Datos del estudiante</h3>
                        <dl class="grid gap-3 sm:grid-cols-2">
                            <div><dt class="text-xs text-zinc-500">Documento</dt><dd class="mt-1 text-sm">{{ $s->estudiante_tipo_documento }} {{ $s->estudiante_numero_documento }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Fecha de nacimiento</dt><dd class="mt-1 text-sm">{{ $s->estudiante_fecha_nacimiento?->format('d/m/Y') ?? 'No registrado' }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Género</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_genero) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Tipo de sangre</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_tipo_sangre) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Lugar de nacimiento</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_lugar_nacimiento) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">EPS</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_eps) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Discapacidad</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_tiene_discapacidad) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Tipo de discapacidad</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_tipo_discapacidad) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Diagnóstico</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_diagnostico_discapacidad) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Grado</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_grado_discapacidad) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Permanencia</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_permanencia_discapacidad) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Grado de atención</dt><dd class="mt-1 text-sm">{{ $valor($s->estudiante_grado_atencion) }}</dd></div>
                        </dl>
                    </section>

                    <section>
                        <h3 class="mb-3 text-sm font-semibold">Padre o acudiente</h3>
                        <dl class="grid gap-3 sm:grid-cols-2">
                            <div><dt class="text-xs text-zinc-500">Documento</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_tipo_documento) }} {{ $valor($s->acudiente_numero_documento) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Nombre</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_nombres) }} {{ $valor($s->acudiente_apellidos) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Género</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_genero) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Parentesco</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_parentesco) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Fecha de nacimiento</dt><dd class="mt-1 text-sm">{{ $s->acudiente_fecha_nacimiento?->format('d/m/Y') ?? 'No registrado' }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Teléfono</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_telefono) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Correo</dt><dd class="mt-1 break-words text-sm">{{ $valor($s->acudiente_correo) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Dirección</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_direccion) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Lugar de trabajo</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_lugar_trabajo) }}</dd></div>
                            <div><dt class="text-xs text-zinc-500">Ocupación</dt><dd class="mt-1 text-sm">{{ $valor($s->acudiente_ocupacion) }}</dd></div>
                        </dl>
                    </section>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClases[$s->estado] ?? 'bg-zinc-100 text-zinc-700' }}">
                    Estado: {{ $estadoTexto[$s->estado] ?? ucfirst($s->estado ?? '') }}
                </span>
                <div class="flex flex-wrap justify-end gap-2">
                    @if ($mostrarAcciones)
                        <form method="POST" action="{{ route('administrativo.solicitudes.estado', $s) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="estado" value="aprobado">
                            <button type="submit" class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">Aprobar</button>
                        </form>
                        <form method="POST" action="{{ route('administrativo.solicitudes.estado', $s) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="estado" value="denegado">
                            <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-red-700">Denegar</button>
                        </form>
                    @endif
                    <button type="button" class="rounded-lg border border-zinc-300 px-3 py-2 text-xs font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800" onclick="document.getElementById('{{ $modalId }}').close()">Cerrar</button>
                </div>
            </div>
        </div>
    </dialog>
@endforeach
