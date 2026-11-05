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

        $response = $this->actingAs($administrativo)->get(route('dashboardAdministrativo'));

        $response->assertOk()->assertSee('Panel del administrativo');
    }

    public function test_administrativo_dashboard_does_not_show_courses_or_evaluation(): void
    {
        $administrativo = User::factory()->create([
            'role' => 'Administrativo',
            'nom_rol' => 'Administrativo',
            'status' => 'Activo',
            'estado' => 'Activo',
        ]);

        $response = $this->actingAs($administrativo)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('Administradores')
            ->assertDontSee('Cursos')
            ->assertDontSee('Evaluacion')
            ->assertDontSee('Ver periodos')
            ->assertDontSee('Grados')
            ->assertDontSee('Asignaturas');
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
