<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periodo')->upsert([
            ['id_periodo' => 1, 'nombre_periodo' => 'Primer Periodo', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-01-20', 'fecha_cierre' => '2026-04-05'],
            ['id_periodo' => 2, 'nombre_periodo' => 'Segundo Periodo', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-04-08', 'fecha_cierre' => '2026-06-14'],
            ['id_periodo' => 3, 'nombre_periodo' => 'Tercer Periodo', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-07-08', 'fecha_cierre' => '2026-09-20'],
            ['id_periodo' => 4, 'nombre_periodo' => 'Cuarto Periodo', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-09-23', 'fecha_cierre' => '2026-11-28'],
            ['id_periodo' => 5, 'nombre_periodo' => 'Periodo Diagnóstico', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-01-15', 'fecha_cierre' => '2026-01-19'],
            ['id_periodo' => 6, 'nombre_periodo' => 'Nivelación Primer Periodo', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-04-06', 'fecha_cierre' => '2026-04-07'],
            ['id_periodo' => 7, 'nombre_periodo' => 'Nivelación Segundo Periodo', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-06-15', 'fecha_cierre' => '2026-06-17'],
            ['id_periodo' => 8, 'nombre_periodo' => 'Nivelación Tercer Periodo', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-09-21', 'fecha_cierre' => '2026-09-22'],
            ['id_periodo' => 9, 'nombre_periodo' => 'Nivelación Final', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-12-01', 'fecha_cierre' => '2026-12-05'],
            ['id_periodo' => 10, 'nombre_periodo' => 'Primer Periodo Académico 2025', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2025, 'fecha_inicio' => '2025-01-20', 'fecha_cierre' => '2025-04-04'],
            ['id_periodo' => 11, 'nombre_periodo' => 'Segundo Periodo Académico 2025', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2025, 'fecha_inicio' => '2025-04-07', 'fecha_cierre' => '2025-06-13'],
            ['id_periodo' => 12, 'nombre_periodo' => 'Tercer Periodo Académico 2025', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2025, 'fecha_inicio' => '2025-07-07', 'fecha_cierre' => '2025-09-19'],
            ['id_periodo' => 13, 'nombre_periodo' => 'Cuarto Periodo Académico 2025', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2025, 'fecha_inicio' => '2025-09-22', 'fecha_cierre' => '2025-11-27'],
            ['id_periodo' => 14, 'nombre_periodo' => 'Primer Periodo Académico 2024', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2024, 'fecha_inicio' => '2024-01-22', 'fecha_cierre' => '2024-04-05'],
            ['id_periodo' => 15, 'nombre_periodo' => 'Segundo Periodo Académico 2024', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2024, 'fecha_inicio' => '2024-04-08', 'fecha_cierre' => '2024-06-14'],
            ['id_periodo' => 16, 'nombre_periodo' => 'Tercer Periodo Académico 2024', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2024, 'fecha_inicio' => '2024-07-08', 'fecha_cierre' => '2024-09-20'],
            ['id_periodo' => 17, 'nombre_periodo' => 'Cuarto Periodo Académico 2024', 'porcentaje_periodo' => 25, 'anio_lectivo' => 2024, 'fecha_inicio' => '2024-09-23', 'fecha_cierre' => '2024-11-29'],
            ['id_periodo' => 18, 'nombre_periodo' => 'Escuela de Verano 2026', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-06-18', 'fecha_cierre' => '2026-07-03'],
            ['id_periodo' => 19, 'nombre_periodo' => 'Semana Cultural 2026', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-10-12', 'fecha_cierre' => '2026-10-16'],
            ['id_periodo' => 20, 'nombre_periodo' => 'Olimpiadas Escolares 2026', 'porcentaje_periodo' => 0, 'anio_lectivo' => 2026, 'fecha_inicio' => '2026-08-18', 'fecha_cierre' => '2026-08-21'],
        ], ['id_periodo'], ['nombre_periodo', 'porcentaje_periodo', 'anio_lectivo', 'fecha_inicio', 'fecha_cierre']);
    }
}
