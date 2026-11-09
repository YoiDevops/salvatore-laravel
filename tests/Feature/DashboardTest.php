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

    public function test_non_student_users_can_visit_the_general_dashboard(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
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
        $user = User::factory()->admin()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
        $this->assertStringNotContainsString('class="dark"', $response->getContent());
        $this->assertStringContainsString('flux.appearance', $response->getContent());
    }
}
