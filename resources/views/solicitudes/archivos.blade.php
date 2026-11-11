<x-layouts::app.sidebar title="Todas las solicitudes">
    <flux:main>
        <div class="mx-auto max-w-[96rem] space-y-6">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#9a761f]">Gestión institucional</p>
                    <flux:heading size="xl" class="mt-2">Todas las solicitudes</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500">Consulta, filtra y descarga las solicitudes según su estado.</p>
                </div>
                <a href="{{ route('administrativo.solicitudes.export', ['estado' => $estadoFiltro]) }}" class="inline-flex items-center justify-center rounded-lg bg-[#d4a017] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#b8860b]">
                    Descargar Excel
                </a>
            </div>

            <section class="border-b border-zinc-200 pb-5 dark:border-zinc-800">
                <div class="mb-3">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Importar archivo</h2>
                    <p class="mt-1 text-xs text-zinc-500">Selecciona un archivo Excel o CSV para guardarlo en el sistema.</p>
                </div>
                <form method="POST" action="{{ route('administrativo.solicitudes.archivos.store') }}" enctype="multipart/form-data" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    @csrf
                    <input type="file" name="archivo" accept=".xls,.xlsx,.csv" required class="block w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-600 file:mr-3 file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-zinc-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:file:text-zinc-200">
                    <button type="submit" class="rounded-lg bg-zinc-800 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-200 dark:text-zinc-900 dark:hover:bg-white">
                        Importar
                    </button>
                </form>
                @error('archivo')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </section>

            <form method="GET" action="{{ route('administrativo.archivos-excel.index') }}" class="mb-5">
                <details class="relative w-fit">
                    <summary class="inline-flex cursor-pointer list-none items-center justify-center gap-2 rounded-xl bg-[#c49a35] px-4 py-2.5 text-sm font-semibold text-[#1f2529] transition hover:bg-[#d8b85c] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/40">
                        <flux:icon name="funnel" class="size-4" />
                        Filtros
                    </summary>
                    <div class="absolute left-0 z-20 mt-2 w-[min(22rem,calc(100vw-2rem))] rounded-2xl border border-zinc-200 bg-white p-4 shadow-xl dark:border-zinc-700 dark:bg-zinc-900">
                        <label for="estado" class="mb-3 block text-xs font-semibold uppercase tracking-[0.14em] text-zinc-500 dark:text-zinc-400">
                            Estado
                            <select id="estado" name="estado" class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm font-normal normal-case tracking-normal text-zinc-800 outline-none transition focus:border-[#c49a35] focus:ring-2 focus:ring-[#c49a35]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100">
                                <option value="todos" @selected($estadoFiltro === 'todos')>Todas</option>
                                <option value="en espera" @selected($estadoFiltro === 'en espera')>En espera</option>
                                <option value="aprobado" @selected($estadoFiltro === 'aprobado')>Aprobadas</option>
                                <option value="denegado" @selected($estadoFiltro === 'denegado')>Denegadas</option>
                            </select>
                        </label>
                        <div class="flex items-center justify-between gap-2 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#c49a35] px-3 py-2 text-sm font-semibold text-[#1f2529] hover:bg-[#d8b85c]">
                                <flux:icon name="check" class="size-4" /> Aplicar
                            </button>
                            @if ($estadoFiltro !== 'todos')
                                <a href="{{ route('administrativo.archivos-excel.index') }}" class="text-sm font-medium text-zinc-500 hover:text-[#9a761f]">Limpiar</a>
                            @endif
                        </div>
                    </div>
                </details>
            </form>

            @include('solicitudes._tablero', ['mostrarAcciones' => false])

            @if ($archivos->isNotEmpty())
                <section class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                    <h2 class="font-semibold">Archivos cargados</h2>
                    <div class="mt-4 overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500 dark:border-zinc-800"><tr><th class="p-3">Archivo</th><th class="p-3">Tamaño</th><th class="p-3">Acciones</th></tr></thead>
                            <tbody>
                                @foreach ($archivos as $archivo)
                                    <tr class="border-b border-zinc-100 dark:border-zinc-800">
                                        <td class="p-3">{{ $archivo->nombre_original }}</td>
                                        <td class="p-3">{{ number_format($archivo->tamano / 1024, 1) }} KB</td>
                                        <td class="p-3"><div class="flex gap-2"><a class="text-sm font-semibold text-[#9a761f] hover:underline" href="{{ route('administrativo.solicitudes.archivos.download', $archivo) }}">Descargar</a><form method="POST" action="{{ route('administrativo.solicitudes.archivos.destroy', $archivo) }}">@csrf @method('DELETE')<button type="submit" class="text-sm font-semibold text-red-600 hover:underline">Eliminar</button></form></div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @endif
        </div>
    </flux:main>
</x-layouts::app.sidebar>
