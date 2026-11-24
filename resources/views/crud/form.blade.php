<x-layouts::app.sidebar :title="$title">
    <flux:main>
        <div class="mx-auto w-full min-w-0 max-w-2xl">
            <flux:heading size="xl" class="mb-3 break-words">{{ $title }}</flux:heading>
            <x-action-help class="mb-6">
                Completa la información y selecciona Guardar. Si vuelves sin guardar, los cambios no se conservarán.
            </x-action-help>

            {{-- Errores de validacion --}}
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-500 p-3 text-sm text-red-400">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ $action }}" class="space-y-4" aria-label="{{ $item ? 'Editar registro' : 'Crear registro' }}">
                @csrf
                @if($method)<input type="hidden" name="_method" value="{{ $method }}">@endif

                @foreach($fields as $field)
                    @php
                        // [0]=campo  [1]=etiqueta  [2]=tipo  [3]=obligatorio  [4]=opciones (solo select)
                        $campo      = $field[0];
                        $etiqueta   = $field[1];
                        $tipo       = $field[2] ?? 'text';
                        $obligatorio= $field[3] ?? false;
                        $opciones   = $field[4] ?? [];
                        $valor      = old($campo, $item ? data_get($item, $campo) : '');
                    @endphp

                    @if($tipo === 'select')
                        <flux:select :label="$etiqueta" :name="$campo" :required="$obligatorio">
                            <flux:select.option value="">-- Seleccione --</flux:select.option>
                            @foreach($opciones as $valorOpcion => $textoOpcion)
                                <flux:select.option
                                    value="{{ $valorOpcion }}"
                                    :selected="(string) $valor === (string) $valorOpcion">
                                    {{ $textoOpcion }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>

                    @elseif($tipo === 'textarea')
                        <flux:textarea :label="$etiqueta" :name="$campo" :required="$obligatorio">{{ $valor }}</flux:textarea>

                    @else
                        <flux:input
                            :label="$etiqueta"
                            :name="$campo"
                            :type="$tipo"
                            :value="$valor"
                            :required="$obligatorio" />
                    @endif
                @endforeach

                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <flux:button class="w-full sm:w-auto" variant="ghost" href="{{ route($resource.'.index') }}" aria-label="Cancelar y volver al listado">Cancelar</flux:button>
                    <flux:button class="w-full sm:w-auto" type="submit" variant="primary" aria-label="Guardar los datos del registro">Guardar</flux:button>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
