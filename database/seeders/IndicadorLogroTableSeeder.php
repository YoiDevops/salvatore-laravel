<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicadorLogroTableSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [1, 1, 1, 1, 'MAT-P1-01', 'Realiza adiciones y sustracciones sencillas hasta de tres cifras correctamente.', 'Procedimental'],
            [2, 2, 1, 2, 'SPA-P1-01', 'Lee textos cortos identificando los personajes principales.', 'Cognitivo'],
            [3, 3, 1, 1, 'NAT-P1-01', 'Clasifica los animales de su entorno en vertebrados e invertebrados.', 'Cognitivo'],
            [4, 4, 1, 2, 'SOC-P1-01', 'Reconoce las funciones de los miembros de su comunidad escolar.', 'Actitudinal'],
            [5, 5, 1, 1, 'ART-P1-01', 'Utiliza la técnica del dactilopintura con precisión y limpieza.', 'Procedimental'],
            [6, 6, 1, 2, 'EFI-P1-01', 'Demuestra coordinación óculo-manual en circuitos deportivos básicos.', 'Procedimental'],
            [7, 7, 1, 1, 'ING-P1-01', 'Pronuncia y comprende el vocabulario de la familia en inglés.', 'Cognitivo'],
            [8, 8, 1, 2, 'INF-P1-01', 'Utiliza el ratón para arrastrar y seleccionar objetos en la pantalla.', 'Procedimental'],
            [9, 9, 1, 1, 'REL-P1-01', 'Manifiesta respeto por las diferencias de sus compañeros de aula.', 'Actitudinal'],
            [10, 10, 1, 2, 'ETI-P1-01', 'Identifica y cumple las normas establecidas en el pacto de aula.', 'Actitudinal'],
            [11, 11, 1, 1, 'MUS-P1-01', 'Acompaña canciones infantiles siguiendo el pulso con instrumentos rítmicos.', 'Procedimental'],
            [12, 12, 1, 2, 'EMP-P1-01', 'Comprende el valor del ahorro mediante el uso de una alcancía escolar.', 'Cognitivo'],
            [13, 13, 1, 1, 'PHI-P1-01', 'Formula preguntas lógicas frente a situaciones problémicas sencillas.', 'Cognitivo'],
            [14, 14, 1, 2, 'HUE-P1-01', 'Participa activamente en la siembra y cuidado de hortalizas escolares.', 'Actitudinal'],
            [15, 15, 1, 1, 'DAN-P1-01', 'Ejecuta pasos básicos de la cumbia con ritmo y coordinación.', 'Procedimental'],
            [16, 16, 1, 2, 'TEA-P1-01', 'Representa personajes de fábulas mediante dramatizaciones infantiles.', 'Procedimental'],
            [17, 17, 1, 1, 'AJE-P1-01', 'Conoce el movimiento correcto de todas las piezas del ajedrez.', 'Cognitivo'],
            [18, 18, 1, 2, 'PLE-P1-01', 'Responde preguntas inferenciales sobre lecturas recomendadas.', 'Cognitivo'],
            [19, 19, 1, 1, 'ROB-P1-01', 'Crea una secuencia simple de bloques para mover un personaje digital.', 'Procedimental'],
            [20, 20, 1, 2, 'PAZ-P1-01', 'Resuelve desacuerdos con sus compañeros mediante el diálogo guiado.', 'Actitudinal'],
        ];

        DB::table('indicador_logro')->upsert(array_map(static fn (array $row): array => [
            'id_indicador' => $row[0],
            'id_asignatura' => $row[1],
            'id_periodo' => $row[2],
            'id_escala' => $row[3],
            'codigo_logro' => $row[4],
            'descripcion_logro' => $row[5],
            'tipo_logro' => $row[6],
        ], $rows), ['id_indicador'], ['id_asignatura', 'id_periodo', 'id_escala', 'codigo_logro', 'descripcion_logro', 'tipo_logro']);
    }
}
