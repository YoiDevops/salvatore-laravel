<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteTableSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [1, 4, 1, 1, null, 'RC', '10987654321', 'Juan Carlos', 'Gómez Rojas', '2019-03-15', 'Masculino', 'O+', 'Bogotá', 'Sura', 'Activo'],
            [2, 5, 2, 2, 1, 'TI', '10987654322', 'Laura Valentina', 'Rojas Fernández', '2018-07-20', 'Femenino', 'A+', 'Soacha', 'Sanitas', 'Activo'],
            [3, 6, 3, 3, null, 'TI', '10987654323', 'Mateo', 'Smith López', '2017-11-05', 'Masculino', 'B+', 'Bogotá', 'Compensar', 'Activo'],
            [4, 7, 4, 4, 2, 'TI', '10987654324', 'Sofia', 'Mendoza Castro', '2016-01-12', 'Femenino', 'O-', 'Bogotá', 'Salud Total', 'Activo'],
            [5, 8, 5, 5, null, 'TI', '10987654325', 'Daniel Esteban', 'Castro Vargas', '2015-05-30', 'Masculino', 'AB+', 'Bogotá', 'Famisanar', 'Activo'],
            [6, 9, 6, 6, null, 'RC', '10987654326', 'Camila Alejandra', 'Vargas Morales', '2019-09-14', 'Femenino', 'A-', 'Soacha', 'Capital Salud', 'Activo'],
            [7, 10, 7, 7, 3, 'TI', '10987654327', 'Samuel David', 'Morales Herrera', '2018-04-18', 'Masculino', 'O+', 'Bogotá', 'Sura', 'Activo'],
            [8, 11, 8, 8, null, 'TI', '10987654328', 'Mariana', 'Navarro Benítez', '2017-08-22', 'Femenino', 'B-', 'Bogotá', 'Sanitas', 'Activo'],
            [9, 12, 9, 9, 4, 'TI', '10987654329', 'Nicolas', 'Navarro Pineda', '2016-12-01', 'Masculino', 'O+', 'Soacha', 'Compensar', 'Activo'],
            [10, 13, 10, 10, null, 'TI', '10987654330', 'Gabriela', 'Benítez Suárez', '2015-02-17', 'Femenino', 'A+', 'Bogotá', 'Salud Total', 'Activo'],
            [11, 14, 11, 11, 5, 'RC', '10987654331', 'Tomas', 'Pineda Johnson', '2019-10-25', 'Masculino', 'O+', 'Bogotá', 'Famisanar', 'Activo'],
            [12, 15, 12, 12, null, 'TI', '10987654332', 'Isabella', 'Suárez Camargo', '2018-06-11', 'Femenino', 'AB-', 'Soacha', 'Capital Salud', 'Activo'],
            [13, 16, 13, 13, null, 'TI', '10987654333', 'Lucas', 'Johnson Ríos', '2017-03-09', 'Masculino', 'O+', 'Bogotá', 'Sura', 'Activo'],
            [14, 17, 14, 14, 6, 'TI', '10987654334', 'Valeria', 'Camargo Duarte', '2016-07-28', 'Femenino', 'A+', 'Bogotá', 'Sanitas', 'Activo'],
            [15, 18, 15, 15, null, 'TI', '10987654335', 'Emmanuel', 'Ríos Lovera', '2015-11-13', 'Masculino', 'B+', 'Soacha', 'Compensar', 'Activo'],
            [16, 19, 16, 16, null, 'RC', '10987654336', 'Luciana', 'Duarte Bracho', '2020-01-05', 'Femenino', 'O+', 'Bogotá', 'Salud Total', 'Activo'],
            [17, 20, 17, 17, 7, 'RC', '10987654337', 'Jerónimo', 'Lovera Ortiz', '2020-05-19', 'Masculino', 'A-', 'Bogotá', 'Famisanar', 'Activo'],
            [18, 21, 18, 18, null, 'RC', '10987654338', 'Salomé', 'Bracho Mejía', '2021-08-30', 'Femenino', 'O+', 'Soacha', 'Capital Salud', 'Activo'],
            [19, 22, 19, 19, 8, 'RC', '10987654339', 'Thiago', 'Ortiz Gómez', '2021-12-14', 'Masculino', 'B+', 'Bogotá', 'Sura', 'Activo'],
            [20, 23, 20, 20, null, 'TI', '10987654340', 'Antonella', 'Mejía Rojas', '2014-09-03', 'Femenino', 'O+', 'Bogotá', 'Sanitas', 'Activo'],
        ];

        DB::table('estudiante')->upsert(array_map(static fn (array $student): array => [
            'id_estudiante' => $student[0],
            'id_usuario' => $student[1],
            'id_curso' => $student[2],
            'id_acudiente' => $student[3],
            'id_caracterizacion' => $student[4],
            'tipo_documento' => $student[5],
            'documento_identidad' => $student[6],
            'nombres_estudiante' => $student[7],
            'apellidos_estudiante' => $student[8],
            'fecha_nacimiento' => $student[9],
            'genero' => $student[10],
            'tipo_sangre' => $student[11],
            'lugar_nacimiento' => $student[12],
            'eps' => $student[13],
            'estado_estudiante' => $student[14],
        ], $students), ['id_estudiante'], ['id_usuario', 'id_curso', 'id_acudiente', 'id_caracterizacion', 'tipo_documento', 'documento_identidad', 'nombres_estudiante', 'apellidos_estudiante', 'fecha_nacimiento', 'genero', 'tipo_sangre', 'lugar_nacimiento', 'eps', 'estado_estudiante']);
    }
}
