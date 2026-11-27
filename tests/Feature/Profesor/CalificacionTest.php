<?php

namespace Tests\Feature\Profesor;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CalificacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_professor_can_open_the_grade_form_from_a_course_student_row(): void
    {
        $profesor = User::factory()->create([
            'role' => 'Profesor',
            'nom_rol' => 'Profesor',
        ]);
        $context = $this->createAcademicContext();

        $this->actingAs($profesor)
            ->get(route('profesor.cursos.show', $context['curso']))
            ->assertOk()
            ->assertSee('Poner nota')
            ->assertSee(route('profesor.cursos.estudiantes.calificaciones.create', [
                $context['curso'],
                $context['estudiante'],
            ]), false);

        $this->get(route('profesor.cursos.estudiantes.calificaciones.create', [
            $context['curso'],
            $context['estudiante'],
        ]))
            ->assertOk()
            ->assertSee('Asignatura e indicador de logro')
            ->assertSee('Matemáticas')
            ->assertSee('Indicador de suma');
    }

    public function test_professor_can_save_and_update_a_decimal_grade_with_its_scale_level(): void
    {
        $profesor = User::factory()->create([
            'role' => 'Profesor',
            'nom_rol' => 'Profesor',
        ]);
        $context = $this->createAcademicContext();
        $route = route('profesor.cursos.estudiantes.calificaciones.store', [
            $context['curso'],
            $context['estudiante'],
        ]);

        $this->actingAs($profesor)
            ->post($route, [
                'id_indicador' => $context['indicador'],
                'nota' => '3.8',
            ])
            ->assertRedirect(route('profesor.cursos.estudiantes.calificaciones.create', [
                'curso' => $context['curso'],
                'estudiante' => $context['estudiante'],
                'indicador' => $context['indicador'],
            ]));

        $this->assertDatabaseHas('calificacion', [
            'id_estudiante' => $context['estudiante'],
            'id_indicador' => $context['indicador'],
            'id_escala' => $context['escalas']['Basico'],
            'nota' => '3.80',
        ]);

        $this->get(route('profesor.cursos.estudiantes.calificaciones.create', [
            'curso' => $context['curso'],
            'estudiante' => $context['estudiante'],
        ]))
            ->assertOk()
            ->assertSee('3.80')
            ->assertSee('Básico')
            ->assertSee(route('profesor.cursos.estudiantes.calificaciones.create', [
                'curso' => $context['curso'],
                'estudiante' => $context['estudiante'],
                'indicador' => $context['indicador'],
            ]), false);

        $this->post($route, [
            'id_indicador' => $context['indicador'],
            'nota' => '4.3',
        ])->assertRedirect();

        $this->assertDatabaseCount('calificacion', 1);
        $this->assertDatabaseHas('calificacion', [
            'id_estudiante' => $context['estudiante'],
            'id_indicador' => $context['indicador'],
            'id_escala' => $context['escalas']['Alto'],
            'nota' => '4.30',
        ]);
    }

    public function test_professor_cannot_save_a_grade_outside_the_configured_scale(): void
    {
        $profesor = User::factory()->create([
            'role' => 'Profesor',
            'nom_rol' => 'Profesor',
        ]);
        $context = $this->createAcademicContext();

        $this->actingAs($profesor)
            ->post(route('profesor.cursos.estudiantes.calificaciones.store', [
                $context['curso'],
                $context['estudiante'],
            ]), [
                'id_indicador' => $context['indicador'],
                'nota' => '5.1',
            ])
            ->assertSessionHasErrors('nota');

        $this->assertDatabaseCount('calificacion', 0);
    }

    private function createAcademicContext(): array
    {
        DB::table('institucion')->insert([
            'nit' => '900000001-1',
            'nombre_institucion' => 'Institución de prueba',
            'direccion_principal' => 'Calle de prueba',
        ]);

        $sede = DB::table('sede')->insertGetId([
            'nit' => '900000001-1',
            'nombre_sede' => 'Sede de prueba',
        ]);

        $grado = DB::table('grado')->insertGetId([
            'nombre_grado' => 'Primero A',
        ]);

        $curso = DB::table('curso')->insertGetId([
            'id_sede' => $sede,
            'id_grado' => $grado,
            'nombre_curso' => '101',
            'cupo_maximo' => '30',
            'jornada' => 'Mañana',
            'ano_lectivo' => '2026',
        ]);

        $acudiente = DB::table('acudiente')->insertGetId([
            'tipo_documento' => 'CC',
            'documento_identidad' => '10000001',
            'nombres_acudiente' => 'Acudiente',
            'apellidos_acudiente' => 'Prueba',
            'genero' => 'Femenino',
            'parentesco_estudiante' => 'Madre',
        ]);

        $usuarioEstudiante = User::factory()->create([
            'role' => 'Estudiante',
            'nom_rol' => 'Estudiante',
        ]);

        $estudiante = DB::table('estudiante')->insertGetId([
            'id_usuario' => $usuarioEstudiante->id_users,
            'id_curso' => $curso,
            'id_acudiente' => $acudiente,
            'tipo_documento' => 'TI',
            'documento_identidad' => '10000002',
            'nombres_estudiante' => 'Estudiante',
            'apellidos_estudiante' => 'Prueba',
            'fecha_nacimiento' => '2015-01-01',
            'genero' => 'Femenino',
            'tipo_sangre' => 'O+',
        ]);

        $area = DB::table('area')->insertGetId([
            'nombre_area' => 'Matemáticas',
        ]);

        $asignatura = DB::table('asignatura')->insertGetId([
            'id_area' => $area,
            'nombre_asignatura' => 'Matemáticas',
            'intensidad_horaria' => 5,
        ]);

        $periodo = DB::table('periodo')->insertGetId([
            'nombre_periodo' => 'Primer periodo',
            'porcentaje_periodo' => 25,
            'anio_lectivo' => 2026,
            'fecha_inicio' => '2026-01-20',
            'fecha_cierre' => '2026-04-05',
        ]);

        $escalas = [];
        foreach ([
            'Superior' => [5, 5],
            'Alto' => [4, 4],
            'Basico' => [3, 3],
            'Bajo' => [1, 2],
        ] as $desempeno => [$minima, $maxima]) {
            $escalas[$desempeno] = DB::table('escala_valoracion')->insertGetId([
                'nombre_desempeno' => $desempeno,
                'nota_minima' => $minima,
                'nota_maxima' => $maxima,
            ]);
        }

        $indicador = DB::table('indicador_logro')->insertGetId([
            'id_asignatura' => $asignatura,
            'id_periodo' => $periodo,
            'id_escala' => $escalas['Superior'],
            'codigo_logro' => 'MAT-P1-01',
            'descripcion_logro' => 'Indicador de suma',
            'tipo_logro' => 'Cognitivo',
        ]);

        return [
            'curso' => $curso,
            'estudiante' => $estudiante,
            'indicador' => $indicador,
            'escalas' => $escalas,
        ];
    }
}
