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
        return view('solicitudes.index', ['solicitudes' => Solicitud::latest('id_solicitud')->paginate(15)]);
    }

    public function exportStudents()
    {
        $columns = ['id_solicitud', 'estudiante_tipo_documento', 'estudiante_numero_documento', 'estudiante_nombres', 'estudiante_apellidos', 'estudiante_fecha_nacimiento', 'estudiante_genero', 'estudiante_tipo_sangre', 'estudiante_lugar_nacimiento', 'estudiante_eps', 'estudiante_estado', 'estudiante_tiene_discapacidad', 'estudiante_tipo_discapacidad', 'estudiante_diagnostico_discapacidad', 'estudiante_grado_discapacidad', 'estudiante_permanencia_discapacidad', 'estudiante_grado_atencion', 'usuario'];
        $labels = ['ID solicitud', 'Tipo documento', 'Documento', 'Nombres', 'Apellidos', 'Fecha nacimiento', 'Género', 'Sangre', 'Lugar nacimiento', 'EPS', 'Estado', 'Discapacidad', 'Tipo discapacidad', 'Diagnóstico', 'Grado', 'Permanencia', 'Atención', 'Usuario'];

        return response()->streamDownload(function () use ($columns, $labels): void {
            $out = fopen('php://output', 'wb');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, $labels, ';');
            Solicitud::query()->orderBy('id_solicitud')->chunk(250, function ($rows) use ($out, $columns): void {
                foreach ($rows as $row) {
                    fputcsv($out, array_map(fn (string $column) => $column === 'usuario' ? '' : (string) ($row->{$column} ?? ''), $columns), ';');
                }
            });
            fclose($out);
        }, 'solicitudes-estudiantes.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function files()
    {
        return view('solicitudes.archivos', ['archivos' => ArchivoExcel::latest()->get()]);
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
