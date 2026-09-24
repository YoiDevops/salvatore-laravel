@php($filterOptions = $filterOptions ?? [])
@php($filterFields = $filterFields ?? [])
@if(!count($filterFields) && count($filterOptions))
    @php($filterFields = [['name' => 'filter', 'label' => $filterLabel ?? 'Filtrar por', 'options' => $filterOptions]])
@endif

<form method="GET" action="{{ url()->current() }}" class="mb-5 rounded-2xl border border-zinc-200 bg-transparent p-4 dark:border-zinc-800">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
        <div class="min-w-0 flex-1">
            <label for="list-search" class="mb-1.5 block text-xs font-semibold uppercase tracking-[0.14em] text-zinc-500 dark:text-zinc-400">Buscar</label>
            <div class="relative">
                <flux:icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-[#c49a35]" />
                <input id="list-search" name="search" type="search" value="{{ request('search') }}" placeholder="{{ $placeholder ?? 'Buscar en este listado...' }}" class="w-full rounded-xl border border-zinc-300 bg-white py-2.5 pl-10 pr-3 text-sm text-zinc-800 outline-none transition placeholder:text-zinc-400 focus:border-[#c49a35] focus:ring-2 focus:ring-[#c49a35]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100" />
            </div>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl border border-zinc-300 bg-white px-4 py-2.5 text-sm font-semibold text-zinc-700 transition hover:border-[#c49a35] hover:text-[#8a681b] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/40 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200">
                <flux:icon name="magnifying-glass" class="size-4" />
                Buscar
            </button>

            <details class="relative">
                <summary class="inline-flex cursor-pointer list-none items-center justify-center gap-2 rounded-xl bg-[#c49a35] px-4 py-2.5 text-sm font-semibold text-[#1f2529] transition hover:bg-[#d8b85c] focus:outline-none focus:ring-2 focus:ring-[#c49a35]/40">
                    <flux:icon name="funnel" class="size-4" />
                    Filtros
                </summary>
                <div class="absolute right-0 z-20 mt-2 w-[min(22rem,calc(100vw-2rem))] rounded-2xl border border-zinc-200 bg-white p-4 shadow-xl dark:border-zinc-700 dark:bg-zinc-900">
                    @forelse($filterFields as $field)
                        <label class="mb-3 block text-xs font-semibold uppercase tracking-[0.14em] text-zinc-500 dark:text-zinc-400">
                            {{ $field['label'] }}
                            <select name="{{ $field['name'] }}" class="mt-1.5 w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm font-normal normal-case tracking-normal text-zinc-800 outline-none transition focus:border-[#c49a35] focus:ring-2 focus:ring-[#c49a35]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100">
                                <option value="">Todos</option>
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}" @selected(request($field['name']) === (string) $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>
                    @empty
                        <p class="text-sm text-zinc-500">No hay filtros disponibles para este listado.</p>
                    @endforelse
                    <div class="flex items-center justify-between gap-2 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#c49a35] px-3 py-2 text-sm font-semibold text-[#1f2529] hover:bg-[#d8b85c]">
                            <flux:icon name="check" class="size-4" /> Aplicar
                        </button>
                        @if(request()->hasAny(['search', 'filter', ...collect($filterFields)->pluck('name')->all()]))
                            <a href="{{ url()->current() }}" class="text-sm font-medium text-zinc-500 hover:text-[#9a761f]">Limpiar</a>
                        @endif
                    </div>
                </div>
            </details>
        </div>
    </div>
</form>
