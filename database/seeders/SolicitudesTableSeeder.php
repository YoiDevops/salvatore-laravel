<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudesTableSeeder extends Seeder
{
    public function run(): void
    {
        $columns = [
            'estudiante_tipo_documento', 'estudiante_numero_documento', 'estudiante_nombres', 'estudiante_apellidos',
            'estudiante_fecha_nacimiento', 'estudiante_genero', 'estudiante_tipo_sangre', 'estudiante_lugar_nacimiento',
            'estudiante_eps', 'estudiante_estado', 'estudiante_tiene_discapacidad', 'estudiante_tipo_discapacidad',
            'estudiante_diagnostico_discapacidad', 'estudiante_grado_discapacidad', 'estudiante_permanencia_discapacidad',
            'estudiante_grado_atencion', 'acudiente_tipo_documento', 'acudiente_numero_documento', 'acudiente_nombres',
            'acudiente_apellidos', 'acudiente_fecha_nacimiento', 'acudiente_genero', 'acudiente_parentesco',
            'acudiente_direccion', 'acudiente_telefono', 'acudiente_correo', 'acudiente_lugar_trabajo',
            'acudiente_ocupacion', 'estado', 'created_at', 'updated_at',
        ];
        $records = [
            [1, 'TI', '23131312313', 'malak', 'sdf', '2001-01-01', 'Masculino', 'O+', 'ad', 'ads', 'Activo', 'No', null, null, null, null, null, 'CC', '13123', 'dqw', 'sfsdf', '2008-01-01', 'Masculino', 'Padre', 'sadsasd', '3123213131', 'sdads@gmail.com', 'dads', 'dadsd', 'denegado', '2026-11-06 00:43:29', '2026-11-10 21:41:00'],
            [2, 'TI', '12121212', 'sadas', 'dasdadsdas', '2021-01-01', 'Masculino', 'O+', 'dfsdfsfd', 'dfsfs', 'Activo', 'No', null, null, null, null, null, 'CC', '2313213', 'dsada', 'dsadada', '2008-01-01', 'Masculino', 'Padre', 'dasdadss2132', '2313132312', 'fsf@gmail.com', 'sddas', '231', 'aprobado', '2026-11-09 21:45:51', '2026-11-10 21:40:54'],
        ];
        $rows = [];

        foreach ($records as $record) {
            $rows[] = array_combine(['id_solicitud', ...$columns], $record);
        }

        DB::table('solicitudes')->upsert($rows, ['id_solicitud'], $columns);
    }
}
