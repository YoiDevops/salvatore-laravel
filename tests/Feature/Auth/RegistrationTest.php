<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_is_enabled(): void
    {
        $this->assertTrue(Route::has('register'));
        $this->assertTrue(Route::has('register.store'));
    }

    public function test_public_registration_creates_an_admin_user_with_hashed_password_and_basic_data(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Ana Gómez',
            'email' => 'test@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ]);

        $response->assertRedirect(route('dashboard'));

        $user = User::query()->where('email', 'test@example.com')->firstOrFail();

        $this->assertSame('Ana Gómez', $user->name);
        $this->assertSame('Administrador', $user->role);
        $this->assertSame('Administrador', $user->nom_rol);
        $this->assertSame('Activo', $user->status);
        $this->assertSame('Activo', $user->estado);
        $this->assertTrue(Hash::check('Password123', $user->password));
    }
}
