<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AsignaturaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('asignatura')->delete();
        
        \DB::table('asignatura')->insert(array (
            0 => 
            array (
                'id_asignatura' => 1,
                'id_area' => 1,
                'nombre_asignatura' => 'Matemáticas e Iniciación a la Geometría',
                'intensidad_horaria' => 5,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Operaciones de suma, resta y formas geométricas simples.',
            ),
            1 => 
            array (
                'id_asignatura' => 2,
                'id_area' => 2,
                'nombre_asignatura' => 'Spanish y Caligrafía',
                'intensidad_horaria' => 6,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Lectura guiada, trazado de letras y producción textual primaria.',
            ),
            2 => 
            array (
                'id_asignatura' => 3,
                'id_area' => 3,
                'nombre_asignatura' => 'Exploración de la Naturaleza',
                'intensidad_horaria' => 4,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Conocimiento del cuerpo humano y los animales.',
            ),
            3 => 
            array (
                'id_asignatura' => 4,
                'id_area' => 4,
                'nombre_asignatura' => 'Mi Entorno y Mi Comunidad',
                'intensidad_horaria' => 3,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Estudio del barrio, la ciudad y símbolos patrios.',
            ),
            4 => 
            array (
                'id_asignatura' => 5,
                'id_area' => 5,
                'nombre_asignatura' => 'Artes Plásticas y Manualidades',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Pintura, modelado en plastilina y rasgado de papel.',
            ),
            5 => 
            array (
                'id_asignatura' => 6,
                'id_area' => 6,
                'nombre_asignatura' => 'Educación Física y Motricidad',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Juegos predeportivos, esquemas rítmicos y equilibrio.',
            ),
            6 => 
            array (
                'id_asignatura' => 7,
                'id_area' => 7,
                'nombre_asignatura' => 'English Kids',
                'intensidad_horaria' => 4,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Vocabulario de colores, animales, familia y comandos en clase.',
            ),
            7 => 
            array (
                'id_asignatura' => 8,
                'id_area' => 8,
                'nombre_asignatura' => 'Sistemas e Iniciación Digital',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Manejo de mouse, teclado y software educativo infantil.',
            ),
            8 => 
            array (
                'id_asignatura' => 9,
                'id_area' => 9,
                'nombre_asignatura' => 'Valores y Espiritualidad',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Reflexiones sobre la familia, la amistad y el respeto.',
            ),
            9 => 
            array (
                'id_asignatura' => 10,
                'id_area' => 10,
                'nombre_asignatura' => 'Cátedra de Ética y Convivencia',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Formación en deberes, derechos y normas de aula.',
            ),
            10 => 
            array (
                'id_asignatura' => 11,
                'id_area' => 11,
                'nombre_asignatura' => 'Iniciación Musical y Canto',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Ejercicios de ritmo, flauta dulce y coros infantiles.',
            ),
            11 => 
            array (
                'id_asignatura' => 12,
                'id_area' => 12,
                'nombre_asignatura' => 'Ahorro y Pequeños Proyectos',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Conceptos básicos de finanzas personales para niños.',
            ),
            12 => 
            array (
                'id_asignatura' => 13,
                'id_area' => 13,
                'nombre_asignatura' => 'Pensamiento Creativo',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Talleres de preguntas curiosas y juegos de lógica.',
            ),
            13 => 
            array (
                'id_asignatura' => 14,
                'id_area' => 14,
                'nombre_asignatura' => 'Huerta y Reciclaje Escolar',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Cuidado de plantas y separación de residuos sólidos.',
            ),
            14 => 
            array (
                'id_asignatura' => 15,
                'id_area' => 15,
                'nombre_asignatura' => 'Danzas Folclóricas',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Bailes típicos regionales colombianos.',
            ),
            15 => 
            array (
                'id_asignatura' => 16,
                'id_area' => 16,
                'nombre_asignatura' => 'Teatro e Improvisación Infantil',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Representaciones de cuentos e historias.',
            ),
            16 => 
            array (
                'id_asignatura' => 17,
                'id_area' => 17,
                'nombre_asignatura' => 'Ajedrez e Ingenio',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Reglas básicas del ajedrez y ejercicios de memoria.',
            ),
            17 => 
            array (
                'id_asignatura' => 18,
                'id_area' => 18,
                'nombre_asignatura' => 'Plan Lector e Interpretación',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Lectura diaria de libros infantiles y guías de trabajo.',
            ),
            18 => 
            array (
                'id_asignatura' => 19,
                'id_area' => 19,
                'nombre_asignatura' => 'Robótica Scratch Jr.',
                'intensidad_horaria' => 2,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Programación por bloques interactivos.',
            ),
            19 => 
            array (
                'id_asignatura' => 20,
                'id_area' => 20,
                'nombre_asignatura' => 'Cátedra de Paz Infantil',
                'intensidad_horaria' => 1,
                'porcentaje_area' => '100.00',
                'descripcion' => 'Talleres para la mediación de conflictos entre pares.',
            ),
        ));
        
        
    }
}