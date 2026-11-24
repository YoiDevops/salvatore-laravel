<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CaracterizacionDiscapacidadTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('caracterizacion_discapacidad')->delete();
        
        \DB::table('caracterizacion_discapacidad')->insert(array (
            0 => 
            array (
                'id_caracterizacion' => 1,
                'tipo_discapacidad' => 'Visual',
                'diagnostico' => 'Baja visión corregible con lentes adaptados',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Ubicación en primera fila de clase',
            ),
            1 => 
            array (
                'id_caracterizacion' => 2,
                'tipo_discapacidad' => 'TDAH',
                'diagnostico' => 'Trastorno por déficit de atención e hiperactividad',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Acompañamiento pedagógico focalizado',
            ),
            2 => 
            array (
                'id_caracterizacion' => 3,
                'tipo_discapacidad' => 'Auditiva',
                'diagnostico' => 'Hipoacusia leve unilateral',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Apoyo con material visual reforzado',
            ),
            3 => 
            array (
                'id_caracterizacion' => 4,
                'tipo_discapacidad' => 'Motora',
                'diagnostico' => 'Diplejía espástica leve',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Rampa de acceso y pupitre adaptado',
            ),
            4 => 
            array (
                'id_caracterizacion' => 5,
                'tipo_discapacidad' => 'Cognitiva',
                'diagnostico' => 'Discapacidad intelectual leve',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Adaptación curricular significativa',
            ),
            5 => 
            array (
                'id_caracterizacion' => 6,
                'tipo_discapacidad' => 'TEA',
                'diagnostico' => 'Trastorno del Espectro Autista Grado 1',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Agenda visual y descansos regulados',
            ),
            6 => 
            array (
                'id_caracterizacion' => 7,
                'tipo_discapacidad' => 'Lenguaje',
                'diagnostico' => 'Dislalia funcional severa',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Terapias de fonoaudiología externas',
            ),
            7 => 
            array (
                'id_caracterizacion' => 8,
                'tipo_discapacidad' => 'Sordoceguera',
                'diagnostico' => 'Baja visión y baja audición combinada',
                'grado_discapacidad' => 'Severa',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Tutoría especializada uno a uno',
            ),
            8 => 
            array (
                'id_caracterizacion' => 9,
                'tipo_discapacidad' => 'Física',
                'diagnostico' => 'Escoliosis idiopática juvenil',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Silla ergonómica especial',
            ),
            9 => 
            array (
                'id_caracterizacion' => 10,
                'tipo_discapacidad' => 'Psicosocial',
                'diagnostico' => 'Trastorno de ansiedad infantil',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Apoyo por psicología escolar',
            ),
            10 => 
            array (
                'id_caracterizacion' => 11,
                'tipo_discapacidad' => 'Multiple',
                'diagnostico' => 'Compromiso motor y de lenguaje',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Permanente',
            'grado_atencion' => 'Plan de ajustes razonables (PIAR)',
            ),
            11 => 
            array (
                'id_caracterizacion' => 12,
                'tipo_discapacidad' => 'Visual',
                'diagnostico' => 'Ceguera total ojo izquierdo',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Material impreso en macrotipo',
            ),
            12 => 
            array (
                'id_caracterizacion' => 13,
                'tipo_discapacidad' => 'Auditiva',
                'diagnostico' => 'Hipoacusia bilateral severa',
                'grado_discapacidad' => 'Severa',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Uso constante de audífonos y lengua de señas',
            ),
            13 => 
            array (
                'id_caracterizacion' => 14,
                'tipo_discapacidad' => 'TDAH',
                'diagnostico' => 'TDAH con predominio hiperactivo',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Estrategias de pausa activa',
            ),
            14 => 
            array (
                'id_caracterizacion' => 15,
                'tipo_discapacidad' => 'Cognitiva',
                'diagnostico' => 'Sindrome de Down',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'PIAR enfocado en habilidades de la vida diaria',
            ),
            15 => 
            array (
                'id_caracterizacion' => 16,
                'tipo_discapacidad' => 'Motora',
                'diagnostico' => 'Secuela de parálisis cerebral leve',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Soporte en escritura manual',
            ),
            16 => 
            array (
                'id_caracterizacion' => 17,
                'tipo_discapacidad' => 'Lenguaje',
                'diagnostico' => 'Tartamudez o disfemia',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Evaluaciones orales adaptadas',
            ),
            17 => 
            array (
                'id_caracterizacion' => 18,
                'tipo_discapacidad' => 'TEA',
                'diagnostico' => 'Asperger / TEA nivel 1',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Estructuración clara de rutinas',
            ),
            18 => 
            array (
                'id_caracterizacion' => 19,
                'tipo_discapacidad' => 'Física',
                'diagnostico' => 'Amputación congénita de miembro superior',
                'grado_discapacidad' => 'Moderada',
                'permanencia' => 'Permanente',
                'grado_atencion' => 'Uso de tecnologías de asistencia',
            ),
            19 => 
            array (
                'id_caracterizacion' => 20,
                'tipo_discapacidad' => 'Psicosocial',
                'diagnostico' => 'Trastorno del estado de ánimo',
                'grado_discapacidad' => 'Leve',
                'permanencia' => 'Temporal',
                'grado_atencion' => 'Acompañamiento psicoorientación',
            ),
        ));
        
        
    }
}