<?php

namespace Tests\Feature\Administrativo;

use App\Models\User;
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

        $response->assertOk()
            ->assertDontSee('Administradores')
            ->assertDontSee('Crear administrador')
            ->assertDontSee('Cursos')
            ->assertDontSee('Evaluacion')
            ->assertDontSee('Ver periodos')
            ->assertDontSee('Grados')
            ->assertDontSee('Asignaturas');
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
