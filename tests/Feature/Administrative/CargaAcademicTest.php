<?php

namespace Tests\Feature\Administrative;

use App\Models\Academico\Area;
use App\Models\Academico\Asignatura;
use App\Models\Academico\Carga;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Institucional\Institucion;
use App\Models\Institucional\Sede;
use App\Models\Profesor\Profesor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CargaAcademicTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_can_manage_teacher_course_subject_assignments(): void
    {
        $administrator = User::factory()->admin()->create();
        [$curso, $asignatura, $profesor] = $this->crearDatosAcademicos();

        $index = $this->actingAs($administrator)->get(route('cargas.index'));
        $index->assertOk();
        $index->assertSee('Cargas académicas');
        $index->assertSee('No hay asignaciones académicas para mostrar.');

        $create = $this->get(route('cargas.create'));
        $create->assertOk();
        $create->assertSee('Nueva carga académica');
        $create->assertSee('Matemáticas');

        $store = $this->post(route('cargas.store'), [
            'id_curso' => $curso->id_curso,
            'id_asignatura' => $asignatura->id_asignatura,
            'id_profesor' => $profesor->id_profesor,
            'intensidad_horaria' => 4,
        ]);
        $store->assertRedirect(route('cargas.index'));
        $store->assertSessionHas('success');

        $carga = Carga::query()->firstOrFail();
        $this->assertSame(4, $carga->intensidad_horaria);
        $this->assertSame('Laura Docente', $carga->profesor->nombres_profesor.' '.$carga->profesor->apellidos_profesor);

        $populatedIndex = $this->get(route('cargas.index'));
        $populatedIndex->assertOk();
        $populatedIndex->assertSee('6A');
        $populatedIndex->assertSee('Matemáticas');
        $populatedIndex->assertSee('Laura Docente');

        $show = $this->get(route('cargas.show', $carga));
        $show->assertOk();
        $show->assertSee('Matemáticas');
        $show->assertSee('4 horas');

        $edit = $this->get(route('cargas.edit', $carga));
        $edit->assertOk();
        $edit->assertSee('Editar carga académica');

        $update = $this->put(route('cargas.update', $carga), [
            'id_curso' => $curso->id_curso,
            'id_asignatura' => $asignatura->id_asignatura,
            'id_profesor' => $profesor->id_profesor,
            'intensidad_horaria' => 5,
        ]);
        $update->assertRedirect(route('cargas.index'));
        $this->assertDatabaseHas('carga_academica', [
            'id_carga' => $carga->id_carga,
            'intensidad_horaria' => 5,
        ]);

        $delete = $this->delete(route('cargas.destroy', $carga));
        $delete->assertRedirect(route('cargas.index'));
        $this->assertDatabaseMissing('carga_academica', ['id_carga' => $carga->id_carga]);
    }

    public function test_duplicate_teacher_assignment_for_the_same_course_and_subject_is_rejected(): void
    {
        $administrator = User::factory()->admin()->create();
        [$curso, $asignatura, $profesor] = $this->crearDatosAcademicos();
        Carga::create([
            'id_curso' => $curso->id_curso,
            'id_asignatura' => $asignatura->id_asignatura,
            'id_profesor' => $profesor->id_profesor,
            'intensidad_horaria' => 4,
        ]);

        $response = $this->actingAs($administrator)->post(route('cargas.store'), [
            'id_curso' => $curso->id_curso,
            'id_asignatura' => $asignatura->id_asignatura,
            'id_profesor' => $profesor->id_profesor,
            'intensidad_horaria' => 4,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('id_profesor');
        $this->assertDatabaseCount('carga_academica', 1);
    }

    public function test_carga_management_is_restricted_to_administrative_roles(): void
    {
        $student = User::factory()->estudiante()->create();

        $this->actingAs($student)
            ->get(route('cargas.index'))
            ->assertForbidden();
    }

    private function crearDatosAcademicos(): array
    {
        $institucion = Institucion::create([
            'nit' => '900123456',
            'nombre_institucion' => 'Institución de prueba',
            'direccion_principal' => 'Calle de prueba',
        ]);
        $sede = Sede::create([
            'nit' => $institucion->nit,
            'nombre_sede' => 'Sede Central',
        ]);
        $grado = Grado::create(['nombre_grado' => 'Sexto']);
        $curso = Curso::create([
            'id_sede' => $sede->id_sede,
            'id_grado' => $grado->id_grado,
            'nombre_curso' => '6A',
            'cupo_maximo' => '30',
            'jornada' => 'Mañana',
        ]);
        $area = Area::create(['nombre_area' => 'Ciencias']);
        $asignatura = Asignatura::create([
            'id_area' => $area->id_area,
            'nombre_asignatura' => 'Matemáticas',
            'intensidad_horaria' => 5,
        ]);
        $usuario = User::factory()->create([
            'name' => 'Laura Docente',
            'email' => 'laura.docente@example.test',
            'role' => 'Profesor',
            'nom_rol' => 'Profesor',
        ]);
        $profesor = Profesor::create([
            'id_usuario' => $usuario->id_users,
            'tipo_documento' => 'CC',
            'documento_profesor' => '123456789',
            'nombres_profesor' => 'Laura',
            'apellidos_profesor' => 'Docente',
            'estado_profesor' => 'Activo',
        ]);

        return [$curso, $asignatura, $profesor];
    }
}
