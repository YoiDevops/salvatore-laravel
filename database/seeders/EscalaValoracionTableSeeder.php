<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalaValoracionTableSeeder extends Seeder
{
    public function run(): void
    {
        $definitions = [
            'Superior' => 'Demuestra un dominio completo y autónomo de los conocimientos básicos.',
            'Alto' => 'Alcanza los objetivos propuestos con apoyo ocasional del docente.',
            'Basico' => 'Consigue desarrollar las competencias mínimas de lectoescritura y cálculo.',
            'Bajo' => 'Presenta dificultades persistentes en los procesos de aprendizaje.',
        ];
        $rows = [];
        $descriptions = [
            'Demuestra creatividad, liderazgo y autonomía en sus actividades.',
            'Cumple satisfactoriamente con la totalidad de los compromisos académicos.',
            'Supera las dificultades con ayuda del plan de mejoramiento.',
            'No alcanza las competencias mínimas esperadas para el grado.',
            'Muestra excelencia académica y convive pacíficamente con sus pares.',
            'Participa activamente en clase y entrega puntualmente las tareas.',
            'Muestra un desempeño regular que requiere refuerzo constante.',
            'Requiere acompañamiento permanente del acudiente y docentes.',
            'Aplica de manera destacada lo aprendido en contextos reales.',
            'Evidencia buen nivel de razonamiento y hábitos de estudio.',
            'Demuestra comprensión parcial de los contenidos del periodo.',
            'Muestra desinterés o serias limitaciones no recuperadas.',
            'Desempeño sobresaliente en pruebas saber e internas.',
            'Buen desempeño en evaluaciones escritas y orales.',
            'Logra pasar los criterios mínimos de evaluación institucional.',
            'Reprueba los indicadores mínimos del periodo académico.',
        ];

        for ($id = 1; $id <= 20; $id++) {
            $level = ['Superior', 'Alto', 'Basico', 'Bajo'][($id - 1) % 4];
            $rows[] = [
                'id_escala' => $id,
                'nombre_desempeno' => $level,
                'nota_minima' => $level === 'Bajo' ? 1 : ['Superior' => 5, 'Alto' => 4, 'Basico' => 3][$level],
                'nota_maxima' => $level === 'Bajo' ? 2 : ['Superior' => 5, 'Alto' => 4, 'Basico' => 3][$level],
                'definicion_escala' => $id <= 4 ? $definitions[$level] : $descriptions[$id - 5],
            ];
        }

        DB::table('escala_valoracion')->upsert($rows, ['id_escala'], ['nombre_desempeno', 'nota_minima', 'nota_maxima', 'definicion_escala']);
    }
}
