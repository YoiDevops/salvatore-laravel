<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

<<<<<<< HEAD
    public function test_users_without_a_specific_role_can_visit_the_general_dashboard(): void
=======
    public function test_administrators_are_redirected_to_their_administrative_dashboard(): void
>>>>>>> Yoiner
    {
        $user = User::factory()->create([
            'role' => 'Usuario',
            'nom_rol' => 'Usuario',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertRedirect(route('dashboardAdmin'));
    }

    public function test_administrative_dashboard_shows_its_hero_and_management_actions(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('dashboardAdmin'));

        $response->assertOk();
        $response->assertSee('Bienvenido al panel administrativo');
        $response->assertSee('alt="Aula de la Institución Educativa Salvatore"', false);
        $response->assertSee('institution-sidebar-always-open');
        $response->assertDontSee('title="Inicio"', false);
        $response->assertDontSee(route('administrativo.solicitudes.index'), false);
        $response->assertDontSee(route('administrativo.archivos-excel.index'), false);
    }

    public function test_students_are_redirected_to_their_portal_from_the_general_dashboard(): void
    {
        $user = User::factory()->estudiante()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertRedirect(route('estudiante.dashboard'));
    }

    public function test_dashboard_theme_is_not_hardcoded_to_dark_mode(): void
    {
        $user = User::factory()->create([
            'role' => 'Usuario',
            'nom_rol' => 'Usuario',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboardAdmin'));

        $response->assertOk();
        $this->assertStringNotContainsString('class="dark"', $response->getContent());
        $this->assertStringContainsString('flux.appearance', $response->getContent());
    }
}
