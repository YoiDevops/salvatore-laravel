<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('area')->delete();
        
        \DB::table('area')->insert(array (
            0 => 
            array (
                'id_area' => 1,
                'nombre_area' => 'Matemáticas Básicas',
                'descripcion' => 'Desarrollo del pensamiento lógico, conteo y operaciones elementales.',
            ),
            1 => 
            array (
                'id_area' => 2,
                'nombre_area' => 'Lengua Castellana y Plan Lector',
                'descripcion' => 'Procesos iniciales de lectoescritura, comprensión y expresión oral.',
            ),
            2 => 
            array (
                'id_area' => 3,
                'nombre_area' => 'Ciencias Naturales y Medio Ambiente',
                'descripcion' => 'Exploración del entorno natural, seres vivos y cuidado del planeta.',
            ),
            3 => 
            array (
                'id_area' => 4,
                'nombre_area' => 'Ciencias Sociales y Ciudadanía',
                'descripcion' => 'Reconocimiento del entorno social, geografía básica e historia escolar.',
            ),
            4 => 
            array (
                'id_area' => 5,
                'nombre_area' => 'Educación Artística y Creatividad',
                'descripcion' => 'Expresión plástica, dibujo, manualidades y apreciación del arte.',
            ),
            5 => 
            array (
                'id_area' => 6,
                'nombre_area' => 'Educación Física, Recreación y Deporte',
                'descripcion' => 'Desarrollo motriz grueso, coordinación, juego y esquema corporal.',
            ),
            6 => 
            array (
                'id_area' => 7,
                'nombre_area' => 'Inglés Primaria',
                'descripcion' => 'Iniciación al idioma extranjero mediante vocabulario y dinámicas.',
            ),
            7 => 
            array (
                'id_area' => 8,
                'nombre_area' => 'Tecnología e Informática Infantil',
                'descripcion' => 'Uso responsable del computador, lógica y herramientas digitales básicas.',
            ),
            8 => 
            array (
                'id_area' => 9,
                'nombre_area' => 'Educación Religiosa y Valores',
                'descripcion' => 'Formación ética, valores comunitarios y convivencia pacífica.',
            ),
            9 => 
            array (
                'id_area' => 10,
                'nombre_area' => 'Ética y Valores Humanos',
                'descripcion' => 'Cuidado personal, empatía y resolución pacífica de conflictos.',
            ),
            10 => 
            array (
                'id_area' => 11,
                'nombre_area' => 'Música y Expresión Sonora',
                'descripcion' => 'Iniciación rítmica, canto coral e instrumentos de percusión menor.',
            ),
            11 => 
            array (
                'id_area' => 12,
                'nombre_area' => 'Emprendimiento Infantil',
                'descripcion' => 'Nociones de ahorro, liderazgo y trabajo colaborativo.',
            ),
            12 => 
            array (
                'id_area' => 13,
                'nombre_area' => 'Pensamiento Crítico y Filosofía para Niños',
                'descripcion' => 'Fomento de la curiosidad, preguntas reflexivas y razonamiento.',
            ),
            13 => 
            array (
                'id_area' => 14,
                'nombre_area' => 'Educación Ambiental y Huerta Escolar',
                'descripcion' => 'Prácticas de reciclaje, siembra y protección de la naturaleza.',
            ),
            14 => 
            array (
                'id_area' => 15,
                'nombre_area' => 'Danza y Expresión Corporal',
                'descripcion' => 'Ritmo corporal, bailes folclóricos y motricidad rítmica.',
            ),
            15 => 
            array (
                'id_area' => 16,
                'nombre_area' => 'Teatro y Expresión Dramática',
                'descripcion' => 'Juegos de rol, dramatización y expresión escénica infantil.',
            ),
            16 => 
            array (
                'id_area' => 17,
                'nombre_area' => 'Lógica y Juegos de Mente',
                'descripcion' => 'Resolución de acertijos, ajedrez básico y rompecabezas.',
            ),
            17 => 
            array (
                'id_area' => 18,
                'nombre_area' => 'Comprensión Lectora Avanzada',
                'descripcion' => 'Estrategias de análisis y argumentación para primaria alta.',
            ),
            18 => 
            array (
                'id_area' => 19,
                'nombre_area' => 'Robótica Educativa Básica',
                'descripcion' => 'Construcción con bloques legos y lógica de programación bloque.',
            ),
            19 => 
            array (
                'id_area' => 20,
                'nombre_area' => 'Convivencia y Paz',
                'descripcion' => 'Cátedra de paz enfocada en el respeto mutuo en el aula.',
            ),
        ));
        
        
    }
}