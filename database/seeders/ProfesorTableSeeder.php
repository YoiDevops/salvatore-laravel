<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorTableSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [1, 24, 'CC', '52123456', 'Roberto', 'Martínez Silva', '3114445566', 'roberto.martinez@losnaranjos.edu.co', 'Calle 80 # 45-10', '2020-01-15', 'Tiempo Completo', 'Activo'],
            [2, 25, 'CC', '52987654', 'Diana Marcela', 'Torres Ruiz', '3157778899', 'diana.torres@losnaranjos.edu.co', 'Carrera 7 # 100-20', '2021-02-01', 'Tiempo Completo', 'Activo'],
            [3, 26, 'CE', '40123890', 'Pedro Antonio', 'Ramírez Castro', '3182223344', 'pedro.ramirez@losnaranjos.edu.co', 'Calle 100 # 15-30', '2019-08-10', 'Tiempo Completo', 'Activo'],
            [4, 27, 'CC', '52234567', 'Martha Elena', 'Zapata Correa', '3101112233', 'martha.zapata@losnaranjos.edu.co', 'Carrera 15 # 50-12', '2018-03-01', 'Tiempo Completo', 'Activo'],
            [5, 28, 'CC', '52345678', 'Gonzalo', 'García Márquez', '3122223344', 'gonzalo.garcia@losnaranjos.edu.co', 'Calle 45 # 20-08', '2022-01-10', 'Medio Tiempo', 'Activo'],
            [6, 29, 'CC', '52456789', 'Luz Marina', 'Ospina Bermúdez', '3133334455', 'luz.ospina@losnaranjos.edu.co', 'Carrera 50 # 12-40', '2017-07-15', 'Tiempo Completo', 'Activo'],
            [7, 30, 'CC', '52567890', 'Carlos Andrés', 'Jaramillo Hoyos', '3144445566', 'carlos.jaramillo@losnaranjos.edu.co', 'Calle 127 # 19-30', '2021-08-20', 'Tiempo Completo', 'Activo'],
            [8, 31, 'CC', '52678901', 'Esperanza', 'Valencia Rendón', '3155556677', 'esperanza.valencia@losnaranjos.edu.co', 'Carrera 9 # 72-15', '2016-02-01', 'Tiempo Completo', 'Activo'],
            [9, 32, 'CC', '52789012', 'Jaime Alberto', 'Londoño Botero', '3166667788', 'jaime.londono@losnaranjos.edu.co', 'Calle 63 # 30-10', '2023-01-16', 'Hora Cátedra', 'Activo'],
            [10, 33, 'CC', '52890123', 'Beatriz Elena', 'Ceballos Zuluaga', '3177778899', 'beatriz.ceballos@losnaranjos.edu.co', 'Carrera 68 # 80-05', '2019-02-01', 'Tiempo Completo', 'Activo'],
            [11, 34, 'CC', '52901234', 'Jorge Mario', 'Echeverri Aristizábal', '3188889900', 'jorge.echeverri@losnaranjos.edu.co', 'Calle 138 # 55-20', '2020-08-10', 'Tiempo Completo', 'Activo'],
            [12, 35, 'CC', '53012345', 'Adriana Maria', 'Villegas Cardona', '3199990011', 'adriana.villegas@losnaranjos.edu.co', 'Carrera 11 # 93-08', '2015-01-20', 'Tiempo Completo', 'Activo'],
            [13, 36, 'CC', '53123456', 'Fernando', 'Restrepo Gómez', '3002223344', 'fernando.restrepo@losnaranjos.edu.co', 'Calle 170 # 15-40', '2022-07-01', 'Medio Tiempo', 'Activo'],
            [14, 37, 'CC', '53234567', 'Claudia Patricia', 'Bedoya Agudelo', '3013334455', 'claudia.bedoya@losnaranjos.edu.co', 'Carrera 24 # 45-10', '2018-09-15', 'Tiempo Completo', 'Activo'],
            [15, 38, 'CC', '53345678', 'Mauricio', 'Montoya Peláez', '3024445566', 'mauricio.montoya@losnaranjos.edu.co', 'Calle 53 # 24-15', '2021-01-18', 'Tiempo Completo', 'Activo'],
            [16, 39, 'CC', '53456789', 'Olga Lucía', 'Arango Castaño', '3035556677', 'olga.arango@losnaranjos.edu.co', 'Carrera 7 # 58-30', '2017-02-01', 'Tiempo Completo', 'Activo'],
            [17, 40, 'CC', '53567890', 'Henry', 'Quintero Marín', '3046667788', 'henry.quintero@losnaranjos.edu.co', 'Calle 80 # 68-12', '2020-01-20', 'Tiempo Completo', 'Activo'],
            [18, 41, 'CC', '53678901', 'Sonia Maria', 'Giraldo Henao', '3057778899', 'sonia.giraldo@losnaranjos.edu.co', 'Carrera 15 # 103-20', '2019-07-10', 'Tiempo Completo', 'Activo'],
            [19, 42, 'CC', '53789012', 'César Augusto', 'Duque Cano', '3068889900', 'cesar.duque@losnaranjos.edu.co', 'Calle 100 # 48-05', '2022-02-01', 'Medio Tiempo', 'Activo'],
            [20, 43, 'CC', '53890123', 'Pilar', 'Múnera Alzate', '3079990011', 'pilar.munera@losnaranjos.edu.co', 'Carrera 30 # 63-25', '2016-08-15', 'Tiempo Completo', 'Activo'],
        ];

        DB::table('profesor')->upsert(array_map(static fn (array $teacher): array => [
            'id_profesor' => $teacher[0],
            'id_usuario' => $teacher[1],
            'tipo_documento' => $teacher[2],
            'documento_profesor' => $teacher[3],
            'nombres_profesor' => $teacher[4],
            'apellidos_profesor' => $teacher[5],
            'telefono_profesor' => $teacher[6],
            'correo_profesor' => $teacher[7],
            'direccion_residencia' => $teacher[8],
            'fecha_ingreso_colegio' => $teacher[9],
            'tipo_contra' => $teacher[10],
            'estado_profesor' => $teacher[11],
        ], $teachers), ['id_profesor'], ['id_usuario', 'tipo_documento', 'documento_profesor', 'nombres_profesor', 'apellidos_profesor', 'telefono_profesor', 'correo_profesor', 'direccion_residencia', 'fecha_ingreso_colegio', 'tipo_contra', 'estado_profesor']);
    }
}
