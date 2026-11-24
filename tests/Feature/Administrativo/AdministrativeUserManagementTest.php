<?php

namespace Tests\Feature\Administrativo;

use App\Models\User;
use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Institucional\Institucion;
use App\Models\Institucional\Sede;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdministrativeUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrativo_can_open_its_panel(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);
        $administrador = User::factory()->create([
            'name' => 'administrador_fuera_del_panel',
            'role' => 'Administrador',
            'nom_rol' => 'Administrador',
        ]);

        $response = $this->actingAs($administrativo)->get(route('dashboardAdministrativo'));

        $response->assertOk()
            ->assertSee('Panel del administrativo')
            ->assertDontSee($administrador->name);
    }

    public function test_administrativo_dashboard_does_not_show_administrators_courses_or_evaluation(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($administrativo)->get(route('dashboard'));

        $response->assertRedirect(route('dashboardAdministrativo'));
    }

    public function test_administrativo_cannot_view_administrator_accounts(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);
        $administrador = User::factory()->create([
            'name' => 'administrador_visible_no',
            'role' => 'Administrador',
            'nom_rol' => 'Administrador',
        ]);

        $response = $this->actingAs($administrativo)->get(route('administrativo.usuarios.index'));

        $response->assertOk()
            ->assertDontSee($administrador->name)
            ->assertDontSee('Administrador');
    }

    public function test_administrativo_cannot_create_an_administrator_account(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($administrativo)->post(route('administrativo.usuarios.store'), [
            'name' => 'administrador_no_creado',
            'email' => 'administrador.no.creado@example.com',
            'password' => 'password123',
            'role' => 'Administrador',
            'status' => 'Activo',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertDatabaseMissing('users', [
            'email' => 'administrador.no.creado@example.com',
        ]);
    }

    public function test_administrativo_can_create_a_teacher_account(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($administrativo)->post(route('administrativo.usuarios.store'), [
            'name' => 'profesor_nuevo',
            'email' => 'profesor.nuevo@example.com',
            'password' => 'password123',
            'role' => 'Profesor',
            'status' => 'Activo',
            'tipo_documento' => 'CC',
            'documento_profesor' => '1234567890',
            'nombres_profesor' => 'Ana María',
            'apellidos_profesor' => 'Gómez Pérez',
            'telefono_profesor' => '3001234567',
            'correo_profesor' => 'ana.gomez@example.com',
            'direccion_residencia' => 'Calle 10 # 20-30',
            'fecha_ingreso_colegio' => '2026-01-15',
            'tipo_contra' => 'Planta',
            'estado_profesor' => 'Activo',
        ]);

        $response->assertRedirect(route('administrativo.usuarios.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'profesor_nuevo',
            'email' => 'profesor.nuevo@example.com',
            'role' => 'Profesor',
            'nom_rol' => 'Profesor',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);
        $usuarioCreado = User::query()->where('email', 'profesor.nuevo@example.com')->firstOrFail();

        $this->assertDatabaseHas('profesor', [
            'documento_profesor' => '1234567890',
            'nombres_profesor' => 'Ana María',
            'apellidos_profesor' => 'Gómez Pérez',
            'id_usuario' => $usuarioCreado->id_users,
        ]);
    }

    public function test_administrativo_can_create_a_student_account_with_acudiente_without_creating_a_request(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);
        $institucion = Institucion::create([
            'nit' => '900123456-7',
            'nombre_institucion' => 'Institución de prueba',
            'direccion_principal' => 'Carrera 1 # 2-3',
        ]);
        $sede = Sede::create([
            'nit' => $institucion->nit,
            'nombre_sede' => 'Sede principal',
        ]);
        $grado = Grado::create(['nombre_grado' => 'Quinto']);
        $curso = Curso::create([
            'id_sede' => $sede->id_sede,
            'id_grado' => $grado->id_grado,
            'nombre_curso' => '5A',
            'cupo_maximo' => '30',
            'jornada' => 'Mañana',
            'ano_lectivo' => '2026',
        ]);

        $response = $this->actingAs($administrativo)->post(route('administrativo.usuarios.store'), [
            'name' => 'estudiante_nuevo',
            'email' => 'estudiante.nuevo@example.com',
            'password' => 'password123',
            'role' => 'Estudiante',
            'status' => 'Activo',
            'id_curso' => $curso->id_curso,
            'tipo_documento' => 'TI',
            'documento_identidad' => '1098765432',
            'nombres_estudiante' => 'Laura',
            'apellidos_estudiante' => 'Gómez',
            'fecha_nacimiento' => '2014-05-10',
            'genero' => 'Femenino',
            'tipo_sangre' => 'O+',
            'lugar_nacimiento' => 'Bogotá',
            'eps' => 'Sura',
            'estado_estudiante' => 'Activo',
            'tiene_discapacidad' => '1',
            'tipo_discapacidad' => 'Visual',
            'diagnostico' => 'Baja visión',
            'grado_discapacidad' => 'Leve',
            'permanencia' => 'Permanente',
            'grado_atencion' => 'Quinto',
            'acudiente_tipo_documento' => 'CC',
            'acudiente_numero_documento' => '523456789',
            'acudiente_nombres' => 'María',
            'acudiente_apellidos' => 'Gómez Pérez',
            'acudiente_fecha_nacimiento' => '1985-02-20',
            'acudiente_genero' => 'Femenino',
            'acudiente_parentesco' => 'Madre',
            'acudiente_direccion' => 'Calle 10 # 20-30',
            'acudiente_telefono' => '3001234567',
            'acudiente_correo' => 'maria.gomez@example.com',
            'acudiente_lugar_trabajo' => 'Colegio de prueba',
            'acudiente_ocupacion' => 'Docente',
        ]);

        $response->assertRedirect(route('administrativo.usuarios.index'));
        $usuarioCreado = User::query()->where('email', 'estudiante.nuevo@example.com')->firstOrFail();
        $acudiente = \App\Models\Estudiante\Acudiente::query()
            ->where('documento_identidad', '523456789')
            ->firstOrFail();

        $this->assertDatabaseHas('estudiante', [
            'id_usuario' => $usuarioCreado->id_users,
            'id_curso' => $curso->id_curso,
            'id_acudiente' => $acudiente->id_acudiente,
            'documento_identidad' => '1098765432',
            'eps' => 'Sura',
        ]);
        $this->assertDatabaseHas('acudiente', [
            'id_acudiente' => $acudiente->id_acudiente,
            'nombres_acudiente' => 'María',
            'correo_acudiente' => 'maria.gomez@example.com',
        ]);
        $this->assertDatabaseCount('solicitudes', 0);
    }

    public function test_administrativo_can_open_the_academic_management_routes(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($administrativo)->get(route('estudiantes.create'));

        $response->assertOk();
    }

    public function test_non_administrativo_users_cannot_manage_these_accounts(): void
    {
        $profesor = User::factory()->profesor()->create([
            'role' => 'Profesor',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($profesor)->get(route('administrativo.usuarios.index'));

        $response->assertForbidden();
    }
}
