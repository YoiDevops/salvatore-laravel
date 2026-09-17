@php
    $listaCursos = $cursos->mapWithKeys(fn($c) => [
        $c->id_curso => $c->nombre_curso.' - '.($c->grado->nombre_grado ?? 'sin grado')
    ]);
    $listaAcudientes = $acudientes->mapWithKeys(fn($a) => [
        $a->id_acudiente => $a->nombres_acudiente.' '.$a->apellidos_acudiente.' ('.$a->documento_identidad.')'
    ]);

    // Categorías de discapacidad homologadas por el MEN/SIMAT (Resolución 113 de 2020).
    // Si el estudiante presenta una condición que no está en la lista, se usa "Otra" y se especifica aparte.
    $categoriasDiscapacidad = [
        'Discapacidad física o motora',
        'Discapacidad visual – baja visión',
        'Discapacidad visual – ceguera',
        'Discapacidad auditiva – hipoacusia o baja audición',
        'Discapacidad auditiva – sordera profunda',
        'Sordoceguera',
        'Discapacidad intelectual',
        'Discapacidad psicosocial (mental)',
        'Discapacidad sistémica',
        'Discapacidad múltiple',
        'Trastorno del espectro autista',
    ];

    // Si el valor guardado (por old()) no coincide con ninguna categoría fija, es porque venía de "Otra".
    $tipoDiscapacidadGuardado = old('tipo_discapacidad', '');
    $tipoDiscapacidadEsConocido = in_array($tipoDiscapacidadGuardado, $categoriasDiscapacidad, true);
    $tipoDiscapacidadInicial = $tipoDiscapacidadGuardado === ''
        ? ''
        : ($tipoDiscapacidadEsConocido ? $tipoDiscapacidadGuardado : 'Otra');
    $tipoDiscapacidadOtraInicial = $tipoDiscapacidadEsConocido ? '' : $tipoDiscapacidadGuardado;
@endphp

<x-layouts::app.sidebar title="Nuevo estudiante">
    <flux:main>
        <div class="max-w-2xl mx-auto">
            <flux:heading size="xl" class="mb-6">Nuevo estudiante</flux:heading>

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-500 p-3 text-sm text-red-400">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- x-data controla si se muestra el bloque de discapacidad --}}
            <form method="POST" action="{{ route('estudiantes.store') }}" class="space-y-4"
                  x-data="{
                      tieneDiscapacidad: @js(old('tiene_discapacidad', '0')),
                      tipoDiscapacidad: @js($tipoDiscapacidadInicial),
                      tipoDiscapacidadOtra: @js($tipoDiscapacidadOtraInicial),
                      get tipoDiscapacidadFinal() {
                          return this.tipoDiscapacidad === 'Otra' ? this.tipoDiscapacidadOtra : this.tipoDiscapacidad;
                      },
                  }">
                @csrf

                <flux:input label="Usuario" name="name" :value="old('name')" required />
                <flux:input label="Correo" name="email" type="email" :value="old('email')" required />
                <flux:input label="Contraseña" name="password" type="password" required />

                <flux:select label="Curso" name="id_curso" required>
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach($listaCursos as $valor => $texto)
                        <flux:select.option value="{{ $valor }}" :selected="old('id_curso') == $valor">{{ $texto }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select label="Acudiente" name="id_acudiente" required>
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach($listaAcudientes as $valor => $texto)
                        <flux:select.option value="{{ $valor }}" :selected="old('id_acudiente') == $valor">{{ $texto }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select label="Tipo de documento" name="tipo_documento" required>
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach(['RC','TI','CC','CE','PASAPORTE','PPT'] as $tipo)
                        <flux:select.option value="{{ $tipo }}" :selected="old('tipo_documento') == $tipo">{{ $tipo }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:input label="Documento" name="documento_identidad" :value="old('documento_identidad')" required />
                <flux:input label="Nombres" name="nombres_estudiante" :value="old('nombres_estudiante')" required />
                <flux:input label="Apellidos" name="apellidos_estudiante" :value="old('apellidos_estudiante')" required />
                <flux:input label="Fecha de nacimiento" name="fecha_nacimiento" type="date" :value="old('fecha_nacimiento')" required />

                <flux:select label="Género" name="genero" required>
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach(['Masculino','Femenino','Otro'] as $g)
                        <flux:select.option value="{{ $g }}" :selected="old('genero') == $g">{{ $g }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select label="Tipo de sangre" name="tipo_sangre" required>
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $ts)
                        <flux:select.option value="{{ $ts }}" :selected="old('tipo_sangre') == $ts">{{ $ts }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:input label="Lugar de nacimiento" name="lugar_nacimiento" :value="old('lugar_nacimiento')" />
                <flux:input label="EPS" name="eps" :value="old('eps')" />

                <flux:select label="Estado" name="estado_estudiante">
                    <flux:select.option value="">-- Seleccione --</flux:select.option>
                    @foreach(['Activo','Retirado','Graduado','Suspendido'] as $e)
                        <flux:select.option value="{{ $e }}" :selected="old('estado_estudiante') == $e">{{ $e }}</flux:select.option>
                    @endforeach
                </flux:select>

                {{-- ---------- Bloque de discapacidad ---------- --}}
                <div class="border-t pt-4 mt-2">
                    <flux:heading size="lg" class="mb-3">Caracterización de discapacidad</flux:heading>

                    {{-- x-model va en el GRUPO: flux:radio no dispara @change porque es un web component,
                         no un <input> nativo. El grupo sí expone el valor seleccionado vía x-model. --}}
                    <flux:radio.group label="¿El estudiante presenta alguna discapacidad?" x-model="tieneDiscapacidad" required>
                        <flux:radio value="1" label="Sí" />
                        <flux:radio value="0" label="No" />
                    </flux:radio.group>

                    {{-- Este hidden es el que realmente viaja al backend --}}
                    <input type="hidden" name="tiene_discapacidad" :value="tieneDiscapacidad">

                    <div x-show="tieneDiscapacidad === '1'" x-cloak class="space-y-4 mt-4 border rounded-lg p-4">
                        <flux:select label="Tipo de discapacidad" x-model="tipoDiscapacidad">
                            <flux:select.option value="">-- Seleccione --</flux:select.option>
                            @foreach($categoriasDiscapacidad as $cat)
                                <flux:select.option value="{{ $cat }}">{{ $cat }}</flux:select.option>
                            @endforeach
                            <flux:select.option value="Otra">Otra (especificar)</flux:select.option>
                        </flux:select>

                        <flux:input x-show="tipoDiscapacidad === 'Otra'" x-cloak
                                    label="Especifique el tipo de discapacidad"
                                    x-model="tipoDiscapacidadOtra" maxlength="60" />

                        {{-- Valor final que se guarda: la categoría elegida, o el texto de "Otra" --}}
                        <input type="hidden" name="tipo_discapacidad" :value="tipoDiscapacidadFinal">

                        <flux:textarea label="Diagnóstico" name="diagnostico">{{ old('diagnostico') }}</flux:textarea>

                        <flux:select label="Grado de discapacidad" name="grado_discapacidad">
                            <flux:select.option value="">-- Seleccione --</flux:select.option>
                            @foreach(['Leve','Moderada','Severa'] as $gd)
                                <flux:select.option value="{{ $gd }}" :selected="old('grado_discapacidad') == $gd">{{ $gd }}</flux:select.option>
                            @endforeach
                        </flux:select>

                        <flux:select label="Permanencia" name="permanencia">
                            <flux:select.option value="">-- Seleccione --</flux:select.option>
                            @foreach(['Temporal','Permanente'] as $p)
                                <flux:select.option value="{{ $p }}" :selected="old('permanencia') == $p">{{ $p }}</flux:select.option>
                            @endforeach
                        </flux:select>

                        <flux:input label="Grado de atención" name="grado_atencion" :value="old('grado_atencion')" />
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <flux:button variant="ghost" href="{{ route('estudiantes.index') }}">Cancelar</flux:button>
                    <flux:button type="submit" variant="primary">Guardar</flux:button>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts::app.sidebar>