<x-layouts::app.sidebar title="Crear cuenta">
    <flux:main>
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#c49a35]">Administración de cuentas</p>
                    <flux:heading size="xl" class="mt-2">Crear cuenta</flux:heading>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Registra un nuevo acceso para un profesor o estudiante.</p>
                </div>
                <a href="{{ route('administrativo.usuarios.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-500 transition hover:text-[#9a761f]">
                    <flux:icon name="arrow-left" class="size-4" /> Volver al listado
                </a>
            </div>

            <section class="overflow-visible rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 bg-zinc-50 px-6 py-5 dark:border-zinc-800 dark:bg-zinc-950/40">
                    <div class="flex items-center gap-3">
                        <span class="rounded-xl bg-[#c49a35]/15 p-2.5 text-[#c49a35]"><flux:icon name="user-plus" class="size-5" /></span>
                        <div>
                            <h2 class="font-semibold text-zinc-900 dark:text-white">Información de acceso</h2>
                            <p class="mt-1 text-sm text-zinc-500">Completa los datos básicos de la cuenta.</p>
                        </div>
                    </div>
                </div>

                @php($rolSeleccionado = old('role', $rolInicial) ?: '')
                <form method="POST" action="{{ route('administrativo.usuarios.store') }}" class="space-y-6 p-6"
                      x-data="{
                          role: @js($rolSeleccionado),
                          hasDisability: @js(old('tiene_discapacidad', '0')),
                      }">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div x-show="role !== ''" x-cloak>
                            <flux:input name="name" label="Usuario" placeholder="Ej. maria.gomez" required />
                        </div>
                        <div x-show="role !== ''" x-cloak>
                            <flux:input name="email" type="email" label="Correo electrónico" placeholder="correo@institucion.edu.co" required />
                        </div>
                        <flux:select id="account-role" name="role" label="Rol" x-model="role" required>
                            <option value="" @selected($rolSeleccionado === '')>Seleccione un rol</option>
                            <option value="Profesor" @selected($rolSeleccionado === 'Profesor')>Profesor</option>
                            <option value="Estudiante" @selected($rolSeleccionado === 'Estudiante')>Estudiante</option>
                        </flux:select>
                        <div x-show="role !== ''" x-cloak>
                            <flux:select name="status" label="Estado" required>
                                <option value="Activo" @selected(old('status', 'Activo') === 'Activo')>Activo</option>
                                <option value="Inactivo" @selected(old('status') === 'Inactivo')>Inactivo</option>
                            </flux:select>
                        </div>
                        <div x-show="role !== ''" x-cloak class="sm:col-span-2">
                            <flux:input name="password" type="password" label="Contraseña" placeholder="Mínimo 6 caracteres" required />
                            <p class="mt-1.5 text-xs text-zinc-500">La contraseña debe tener al menos 6 caracteres.</p>
                        </div>
                    </div>

                        <fieldset id="professor-fields" x-show="role === 'Profesor'" x-cloak :disabled="role !== 'Profesor'" class="sm:col-span-2">
                            <div class="mb-5 border-t border-zinc-200 pt-5 dark:border-zinc-800">
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Datos del profesor</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Completa la información que se guardará en la ficha del profesor.</p>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <flux:select name="tipo_documento" label="Tipo de documento">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="CC" @selected(old('tipo_documento') === 'CC')>Cédula de ciudadanía</option>
                                    <option value="CE" @selected(old('tipo_documento') === 'CE')>Cédula de extranjería</option>
                                    <option value="PASAPORTE" @selected(old('tipo_documento') === 'PASAPORTE')>Pasaporte</option>
                                    <option value="PPT" @selected(old('tipo_documento') === 'PPT')>PPT</option>
                                </flux:select>
                                <flux:input name="documento_profesor" label="Número de documento" value="{{ old('documento_profesor') }}" />
                                <flux:input name="nombres_profesor" label="Nombres" value="{{ old('nombres_profesor') }}" />
                                <flux:input name="apellidos_profesor" label="Apellidos" value="{{ old('apellidos_profesor') }}" />
                                <flux:input name="telefono_profesor" label="Teléfono" value="{{ old('telefono_profesor') }}" />
                                <flux:input name="correo_profesor" type="email" label="Correo personal" value="{{ old('correo_profesor') }}" />
                                <flux:input name="direccion_residencia" label="Dirección de residencia" value="{{ old('direccion_residencia') }}" />
                                <flux:input name="fecha_ingreso_colegio" type="date" label="Fecha de ingreso al colegio" value="{{ old('fecha_ingreso_colegio') }}" />
                                <flux:select name="tipo_contra" label="Tipo de contrato">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="Planta" @selected(old('tipo_contra') === 'Planta')>Planta</option>
                                    <option value="Provisional" @selected(old('tipo_contra') === 'Provisional')>Provisional</option>
                                    <option value="Prestación de servicios" @selected(old('tipo_contra') === 'Prestación de servicios')>Prestación de servicios</option>
                                </flux:select>
                                <flux:select name="estado_profesor" label="Estado del profesor">
                                    <option value="">Usar estado de la cuenta</option>
                                    <option value="Activo" @selected(old('estado_profesor', 'Activo') === 'Activo')>Activo</option>
                                    <option value="Inactivo" @selected(old('estado_profesor') === 'Inactivo')>Inactivo</option>
                                    <option value="Licencia" @selected(old('estado_profesor') === 'Licencia')>Licencia</option>
                                </flux:select>
                            </div>
                        </fieldset>

                        <fieldset id="student-fields" x-show="role === 'Estudiante'" x-cloak :disabled="role !== 'Estudiante'" class="sm:col-span-2">
                            <div class="mb-5 border-t border-zinc-200 pt-5 dark:border-zinc-800">
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Datos del estudiante</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Incluye la información académica, personal y del padre o acudiente.</p>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <flux:select name="id_curso" label="Curso">
                                    <option value="">Seleccione un curso</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id_curso }}" @selected((string) old('id_curso') === (string) $curso->id_curso)>
                                            {{ $curso->nombre_curso }}{{ $curso->grado ? ' - '.$curso->grado->nombre_grado : '' }}
                                        </option>
                                    @endforeach
                                </flux:select>
                                <flux:select name="tipo_documento" label="Tipo de documento">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach (['RC', 'TI', 'CC', 'CE', 'PASAPORTE', 'PPT'] as $tipo)
                                        <option value="{{ $tipo }}" @selected(old('tipo_documento') === $tipo)>{{ $tipo }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:input name="documento_identidad" label="Documento del estudiante" value="{{ old('documento_identidad') }}" />
                                <flux:input name="nombres_estudiante" label="Nombres del estudiante" value="{{ old('nombres_estudiante') }}" />
                                <flux:input name="apellidos_estudiante" label="Apellidos del estudiante" value="{{ old('apellidos_estudiante') }}" />
                                <flux:input name="fecha_nacimiento" type="date" label="Fecha de nacimiento" value="{{ old('fecha_nacimiento') }}" />
                                <flux:select name="genero" label="Género">
                                    <option value="">Seleccione un género</option>
                                    @foreach (['Masculino', 'Femenino', 'Otro'] as $genero)
                                        <option value="{{ $genero }}" @selected(old('genero') === $genero)>{{ $genero }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:select name="tipo_sangre" label="Tipo de sangre">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipoSangre)
                                        <option value="{{ $tipoSangre }}" @selected(old('tipo_sangre') === $tipoSangre)>{{ $tipoSangre }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:input name="lugar_nacimiento" label="Lugar de nacimiento" value="{{ old('lugar_nacimiento') }}" />
                                <flux:input name="eps" label="EPS" value="{{ old('eps') }}" />
                                <flux:select name="estado_estudiante" label="Estado del estudiante">
                                    <option value="">Activo por defecto</option>
                                    @foreach (['Activo', 'Retirado', 'Graduado', 'Suspendido'] as $estado)
                                        <option value="{{ $estado }}" @selected(old('estado_estudiante') === $estado)>{{ $estado }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:select name="tiene_discapacidad" label="¿Tiene alguna discapacidad?" x-model="hasDisability">
                                    <option value="0" @selected(old('tiene_discapacidad', '0') === '0')>No</option>
                                    <option value="1" @selected(old('tiene_discapacidad') === '1')>Sí</option>
                                </flux:select>
                            </div>

                            <div x-show="hasDisability === '1'" x-cloak class="mt-5 grid gap-5 rounded-xl border border-amber-200 bg-amber-50/50 p-5 dark:border-amber-900/50 dark:bg-amber-950/20 sm:grid-cols-2">
                                <flux:input name="tipo_discapacidad" label="Tipo de discapacidad" value="{{ old('tipo_discapacidad') }}" />
                                <flux:input name="diagnostico" label="Diagnóstico" value="{{ old('diagnostico') }}" />
                                <flux:select name="grado_discapacidad" label="Grado de discapacidad">
                                    <option value="">Seleccione un grado</option>
                                    @foreach (['Leve', 'Moderada', 'Severa'] as $grado)
                                        <option value="{{ $grado }}" @selected(old('grado_discapacidad') === $grado)>{{ $grado }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:select name="permanencia" label="Permanencia">
                                    <option value="">Seleccione una permanencia</option>
                                    @foreach (['Temporal', 'Permanente'] as $permanencia)
                                        <option value="{{ $permanencia }}" @selected(old('permanencia') === $permanencia)>{{ $permanencia }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:input name="grado_atencion" label="Grado de atención" value="{{ old('grado_atencion') }}" />
                            </div>

                            <div class="mt-8 border-t border-zinc-200 pt-5 dark:border-zinc-800">
                                <h3 class="font-semibold text-zinc-900 dark:text-white">Datos del padre o acudiente</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Estos datos se guardarán en la ficha del acudiente y quedarán relacionados con el estudiante.</p>
                            </div>

                            <div class="mt-5 grid gap-5 sm:grid-cols-2">
                                <flux:select name="acudiente_tipo_documento" label="Tipo de documento del acudiente">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach (['CC', 'TI', 'CE', 'PASAPORTE', 'PEP', 'PPT'] as $tipo)
                                        <option value="{{ $tipo }}" @selected(old('acudiente_tipo_documento') === $tipo)>{{ $tipo }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:input name="acudiente_numero_documento" label="Documento del acudiente" value="{{ old('acudiente_numero_documento') }}" />
                                <flux:input name="acudiente_nombres" label="Nombres del acudiente" value="{{ old('acudiente_nombres') }}" />
                                <flux:input name="acudiente_apellidos" label="Apellidos del acudiente" value="{{ old('acudiente_apellidos') }}" />
                                <flux:input name="acudiente_fecha_nacimiento" type="date" label="Fecha de nacimiento del acudiente" value="{{ old('acudiente_fecha_nacimiento') }}" />
                                <flux:select name="acudiente_genero" label="Género del acudiente">
                                    <option value="">Seleccione un género</option>
                                    @foreach (['Masculino', 'Femenino', 'Otro'] as $genero)
                                        <option value="{{ $genero }}" @selected(old('acudiente_genero') === $genero)>{{ $genero }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:input name="acudiente_parentesco" label="Parentesco" value="{{ old('acudiente_parentesco') }}" />
                                <flux:input name="acudiente_direccion" label="Dirección de residencia" value="{{ old('acudiente_direccion') }}" />
                                <flux:input name="acudiente_telefono" label="Teléfono del acudiente" value="{{ old('acudiente_telefono') }}" />
                                <flux:input name="acudiente_correo" type="email" label="Correo del acudiente" value="{{ old('acudiente_correo') }}" />
                                <flux:input name="acudiente_lugar_trabajo" label="Lugar de trabajo" value="{{ old('acudiente_lugar_trabajo') }}" />
                                <flux:input name="acudiente_ocupacion" label="Ocupación" value="{{ old('acudiente_ocupacion') }}" />
                            </div>
                        </fieldset>

                    <div x-show="role !== ''" x-cloak class="flex flex-col-reverse gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-800 sm:flex-row sm:justify-end">
                        <flux:button variant="ghost" href="{{ route('administrativo.usuarios.index') }}">Cancelar</flux:button>
                        <flux:button variant="primary" icon="check" type="submit">Guardar cuenta</flux:button>
                    </div>
                </form>
            </section>
        </div>
    </flux:main>
</x-layouts::app.sidebar>
