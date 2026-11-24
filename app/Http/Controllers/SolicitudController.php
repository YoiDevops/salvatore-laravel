<?php

namespace App\Http\Controllers;

use App\Models\ArchivoExcel;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $estado = $request->validate([
            'estado' => ['required', 'in:'.Solicitud::ESTADO_APROBADO.','.Solicitud::ESTADO_DENEGADO],
        ])['estado'];

        $solicitud->update(['estado' => $estado]);

        return back()->with('success', 'La solicitud fue marcada como '.$estado.'.');
    }

    private function solicitudesPorEstado(string $estado)
    {
        return Solicitud::query()
            ->when($estado !== 'todos', fn ($query) => $query->where('estado', $estado))
            ->latest('id_solicitud')
            ->paginate(15);
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
                ->when($estado !== 'todos', fn ($query) => $query->where('estado', $estado))
                ->orderBy('id_solicitud')
                ->chunk(250, function ($rows) use ($out, $columns, $disabilityColumns): void {
                    foreach ($rows as $row) {
                        $hasNoDisability = strcasecmp(trim((string) $row->estudiante_tiene_discapacidad), 'No') === 0;

                        fputcsv($out, array_map(function (string $column) use ($row, $disabilityColumns, $hasNoDisability): string {
                            if ($hasNoDisability && in_array($column, $disabilityColumns, true)) {
                                return 'No aplica';
                            }

                            return $column === 'usuario' ? '' : (string) ($row->{$column} ?? '');
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
