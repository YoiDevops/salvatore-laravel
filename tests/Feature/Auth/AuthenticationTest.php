<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use Laravel\Passkeys\Contracts\PasskeyLoginResponse;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertOk()
            ->assertSee('Número de documento, usuario o correo')
            ->assertSee('la contraseña enviada al correo');
    }

    public function test_administrators_can_authenticate_with_email_and_username(): void
    {
        $user = User::factory()->admin()->create();

        foreach ([$user->email, $user->name] as $identifier) {
            $response = $this->post(route('login.store'), [
                'email' => $identifier,
                'password' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('dashboardAdmin', absolute: false));

            $this->assertAuthenticatedAs($user);
            $this->post(route('logout'));
        }
    }

    public function test_team_test_accounts_can_authenticate_with_their_username(): void
    {
        foreach (['andres', 'yoiner', 'YOJHAN'] as $username) {
            $user = User::factory()->create(['name' => $username]);

            $this->post(route('login.store'), [
                'email' => mb_strtolower($username),
                'password' => 'password',
            ])->assertSessionHasNoErrors();

            $this->assertAuthenticatedAs($user);
            $this->post(route('logout'));
        }
    }

    public function test_administrative_accounts_can_authenticate_with_email(): void
    {
        $user = User::factory()->create([
            'email' => 'secretaria@example.test',
            'nom_rol' => 'Administrativo',
        ]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasNoErrors()
            ->assertRedirect(route('dashboardAdministrativo', absolute: false));

        $this->assertAuthenticatedAs($user);
    }

    public function test_students_cannot_authenticate_with_their_email(): void
    {
        $user = User::factory()->estudiante()->create();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrorsIn('email');

        $this->assertGuest();
    }

    public function test_passkey_login_response_redirects_students_to_their_portal(): void
    {
        $user = User::factory()->create();

        $request = Request::create(route('login', absolute: false), 'GET', server: [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $request->setLaravelSession($this->app['session.store']);
        $request->setUserResolver(fn () => $user);

        $jsonResponse = app(PasskeyLoginResponse::class)->toResponse($request);

        $this->assertSame(
            route('estudiante.dashboard'),
            $jsonResponse->getData()->redirect,
        );
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrorsIn('email');

        $this->assertGuest();
    }

    public function test_users_with_two_factor_enabled_are_redirected_to_two_factor_challenge(): void
    {
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two-factor authentication is not enabled.');
        }

        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
        ]);

        $user = User::factory()->admin()->withTwoFactor()->create();

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('two-factor.login'));
        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
