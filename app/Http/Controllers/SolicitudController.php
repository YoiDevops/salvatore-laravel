<?php

namespace App\Http\Controllers;

use App\Mail\SolicitudAprobada;
use App\Models\ArchivoExcel;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class SolicitudController extends Controller
{
    public function index()
    {
        return view('solicitudes.index', [
            'solicitudes' => $this->solicitudesPorEstado(Solicitud::ESTADO_EN_ESPERA),
        ]);
    }

    public function updateStatus(Request $request, Solicitud $solicitud)
    {
        $datos = $request->validate([
            'estado' => ['required', 'in:'.Solicitud::ESTADO_APROBADO.','.Solicitud::ESTADO_DENEGADO],
            'role' => ['nullable', Rule::in(['Estudiante'])],
        ]);
        $estado = $datos['estado'];
        $rolCuenta = $estado === Solicitud::ESTADO_APROBADO
            ? ($datos['role'] ?? 'Estudiante')
            : null;

        $resultado = DB::transaction(function () use ($solicitud, $estado, $rolCuenta): array {
            $solicitud = Solicitud::query()
                ->lockForUpdate()
                ->findOrFail($solicitud->getKey());

            if ($solicitud->estado !== Solicitud::ESTADO_EN_ESPERA) {
                return ['atendida' => true];
            }

            if ($estado === Solicitud::ESTADO_DENEGADO) {
                $solicitud->update(['estado' => $estado]);

                return ['atendida' => false, 'denegada' => true];
            }

            $correo = mb_strtolower(trim($solicitud->acudiente_correo));
            if (mb_strlen($correo) > 100) {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede crear la cuenta: el correo supera el máximo permitido para iniciar sesión.',
                ]);
            }

            $documento = trim((string) $solicitud->estudiante_numero_documento);
            if ($documento === '') {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede aprobar la solicitud porque falta el documento del estudiante.',
                ]);
            }

            $usuarioPorCorreo = User::query()
                ->whereRaw('LOWER(TRIM(email)) = ?', [$correo])
                ->first();
            $usuariosPorDocumento = $this->usuariosConDocumento($documento);

            if ($usuariosPorDocumento->count() > 1) {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede aprobar la solicitud porque el documento está vinculado a más de una cuenta.',
                ]);
            }

            $usuarioPorDocumento = $usuariosPorDocumento->first();
            if ($usuarioPorCorreo && $usuarioPorDocumento
                && $usuarioPorCorreo->id_users !== $usuarioPorDocumento->id_users) {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede aprobar la solicitud porque el correo y el documento ya pertenecen a cuentas distintas.',
                ]);
            }

            $usuario = $usuarioPorCorreo ?? $usuarioPorDocumento;

            if ($usuario && strtolower($usuario->effective_role) !== 'estudiante') {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede aprobar la solicitud porque el correo ya pertenece a una cuenta con otro rol.',
                ]);
            }

            if ($usuario && in_array(mb_strtolower(trim($usuario->name)), ['andres', 'yoiner', 'yojhan'], true)) {
                throw ValidationException::withMessages([
                    'solicitud' => 'No se puede asociar la solicitud a una cuenta de prueba del equipo.',
                ]);
            }

            if ($usuario) {
                $documentoEnPerfil = trim((string) $usuario->estudiante()->value('documento_identidad'));
                $tieneOtraSolicitudAprobada = $usuario->solicitudes()
                    ->where('estado', Solicitud::ESTADO_APROBADO)
                    ->where('estudiante_numero_documento', '!=', $documento)
                    ->exists();

                if (($documentoEnPerfil !== '' && $documentoEnPerfil !== $documento) || $tieneOtraSolicitudAprobada) {
                    throw ValidationException::withMessages([
                        'solicitud' => 'No se puede aprobar la solicitud porque la cuenta ya está vinculada a otro documento de estudiante.',
                    ]);
                }
            }

            $contrasenaTemporal = Str::random(20);

            if ($usuario) {
                $usuario->forceFill([
                    'email' => $correo,
                    'password' => Hash::make($contrasenaTemporal),
                    'role' => $rolCuenta,
                    'status' => 'Activo',
                    'nom_rol' => $rolCuenta,
                    'estado' => 'Activo',
                ])->save();
            } else {
                $usuario = User::create([
                    'name' => $this->nombreUsuario($solicitud),
                    'email' => $correo,
                    'password' => Hash::make($contrasenaTemporal),
                    'role' => $rolCuenta,
                    'status' => 'Activo',
                    'nom_rol' => $rolCuenta,
                    'estado' => 'Activo',
                ]);
            }

            $solicitud->update([
                'estado' => Solicitud::ESTADO_APROBADO,
                'id_usuario' => $usuario->id_users,
            ]);

            return [
                'atendida' => false,
                'denegada' => false,
                'solicitud' => $solicitud,
                'usuario' => $usuario,
                'contrasena_temporal' => $contrasenaTemporal,
            ];
        });

        if ($resultado['atendida']) {
            return back()->with('warning', 'Esta solicitud ya había sido atendida.');
        }

        if ($resultado['denegada']) {
            return back()->with('success', 'La solicitud se marcó como denegada. No se creó ninguna cuenta.');
        }

        try {
            Mail::to($resultado['solicitud']->acudiente_correo)->send(new SolicitudAprobada(
                $resultado['solicitud'],
                $resultado['usuario'],
                $resultado['contrasena_temporal'],
            ));
        } catch (Throwable $exception) {
            report($exception);

            return back()->with('warning', 'La solicitud fue aprobada y la cuenta quedó activa, pero no se pudo enviar el correo. Revisa la configuración del correo y ayuda al usuario a restablecer su contraseña.');
        }

        return back()->with('success', 'La solicitud fue aprobada, la cuenta de estudiante quedó activa y se envió el correo. La asignación de curso o grado queda pendiente.');
    }

    private function solicitudesPorEstado(string $estado)
    {
        return Solicitud::query()
            ->when($estado !== 'todos', fn ($query) => $query->where('estado', $estado))
            ->with('usuario')
            ->latest('id_solicitud')
            ->paginate(15);
    }

    private function nombreUsuario(Solicitud $solicitud): string
    {
        $nombreCompleto = trim($solicitud->estudiante_nombres.' '.$solicitud->estudiante_apellidos);
        $nombre = mb_substr($nombreCompleto, 0, 30);

        if (! User::query()->where('name', $nombre)->exists()) {
            return $nombre;
        }

        $contador = 1;
        do {
            $sufijo = ' #'.$solicitud->id_solicitud.($contador > 1 ? '-'.$contador : '');
            $nombre = mb_substr($nombreCompleto, 0, 30 - mb_strlen($sufijo)).$sufijo;
            $contador++;
        } while (User::query()->where('name', $nombre)->exists());

        return $nombre;
    }

    private function usuariosConDocumento(string $documento): EloquentCollection
    {
        return User::query()
            ->where(function ($query) use ($documento): void {
                $query->whereHas('estudiante', fn ($query) => $query->where('documento_identidad', $documento))
                    ->orWhereHas('profesor', fn ($query) => $query->where('documento_profesor', $documento))
                    ->orWhereHas('solicitudes', fn ($query) => $query
                        ->where('estado', Solicitud::ESTADO_APROBADO)
                        ->where('estudiante_numero_documento', $documento));
            })
            ->limit(2)
            ->get();
    }

    public function exportStudents(?Request $request = null)
    {
        $estado = $request?->query('estado', 'todos') ?? 'todos';
        abort_unless(in_array($estado, ['todos', ...Solicitud::ESTADOS], true), 422);

        $columns = ['id_solicitud', 'estudiante_tipo_documento', 'estudiante_numero_documento', 'estudiante_nombres', 'estudiante_apellidos', 'estudiante_fecha_nacimiento', 'estudiante_genero', 'estudiante_tipo_sangre', 'estudiante_lugar_nacimiento', 'estudiante_eps', 'estudiante_estado', 'estudiante_tiene_discapacidad', 'estudiante_tipo_discapacidad', 'estudiante_diagnostico_discapacidad', 'estudiante_grado_discapacidad', 'estudiante_permanencia_discapacidad', 'estudiante_grado_atencion', 'usuario', 'estado'];
        $disabilityColumns = ['estudiante_tipo_discapacidad', 'estudiante_diagnostico_discapacidad', 'estudiante_grado_discapacidad', 'estudiante_permanencia_discapacidad', 'estudiante_grado_atencion'];
        $labels = ['ID solicitud', 'Tipo documento', 'Documento', 'Nombres', 'Apellidos', 'Fecha nacimiento', 'Género', 'Sangre', 'Lugar nacimiento', 'EPS', 'Estado', 'Discapacidad', 'Tipo discapacidad', 'Diagnóstico', 'Grado', 'Permanencia', 'Atención', 'Usuario'];

        $labels[] = 'Estado solicitud';
        $filename = $estado === 'todos' ? 'todas-las-solicitudes.csv' : 'solicitudes-'.$estado.'.csv';

        return response()->streamDownload(function () use ($columns, $disabilityColumns, $labels, $estado): void {
            $out = fopen('php://output', 'wb');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, $labels, ';');
            Solicitud::query()
                ->with('usuario')
                ->when($estado !== 'todos', fn ($query) => $query->where('estado', $estado))
                ->orderBy('id_solicitud')
                ->chunk(250, function ($rows) use ($out, $columns, $disabilityColumns): void {
                    foreach ($rows as $row) {
                        $hasNoDisability = strcasecmp(trim((string) $row->estudiante_tiene_discapacidad), 'No') === 0;

                        fputcsv($out, array_map(function (string $column) use ($row, $disabilityColumns, $hasNoDisability): string {
                            if ($hasNoDisability && in_array($column, $disabilityColumns, true)) {
                                return 'No aplica';
                            }

                            return $column === 'usuario'
                                ? (string) ($row->usuario?->email ?? '')
                                : (string) ($row->{$column} ?? '');
                        }, $columns), ';');
                    }
                });
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function files(Request $request)
    {
        $estado = $request->query('estado', 'todos');
        abort_unless(in_array($estado, ['todos', ...Solicitud::ESTADOS], true), 422);

        return view('solicitudes.archivos', [
            'archivos' => ArchivoExcel::latest()->get(),
            'solicitudes' => $this->solicitudesPorEstado($estado)->withQueryString(),
            'estadoFiltro' => $estado,
        ]);
    }

    public function upload(Request $request)
    {
        $file = $request->validate(['archivo' => 'required|file|mimes:xls,xlsx,csv|max:20480'])['archivo'];
        $path = $file->store('solicitudes/excel');
        ArchivoExcel::create(['nombre_original' => $file->getClientOriginalName(), 'ruta' => $path, 'mime_type' => $file->getClientMimeType(), 'tamano' => $file->getSize(), 'id_usuario' => auth()->id()]);

        return back()->with('success', 'Archivo guardado correctamente.');
    }

    public function downloadFile(ArchivoExcel $archivo)
    {
        abort_unless(Storage::exists($archivo->ruta), 404);

        return Storage::download($archivo->ruta, $archivo->nombre_original);
    }

    public function destroyFile(ArchivoExcel $archivo)
    {
        Storage::delete($archivo->ruta);
        $archivo->delete();

        return back()->with('success', 'Archivo eliminado correctamente.');
    }
}
