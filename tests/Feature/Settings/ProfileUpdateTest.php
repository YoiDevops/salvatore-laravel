<?php

namespace Tests\Feature\Settings;

use App\Models\Academico\Curso;
use App\Models\Academico\Grado;
use App\Models\Estudiante\Acudiente;
use App\Models\Estudiante\Estudiante;
use App\Models\Institucional\Institucion;
use App\Models\Institucional\Sede;
use App\Models\Profesor\Profesor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->get(route('profile.edit'))
            ->assertOk()
            ->assertSee('Institución Educativa')
            ->assertSee('institution-app-content')
            ->assertSee('Configuración')
            ->assertSee('Mi perfil')
            ->assertSee('Seguridad')
            ->assertSee('Apariencia');
    }

    public function test_professor_profile_displays_professional_information(): void
    {
        $user = User::factory()->create(['role' => 'Profesor']);

        Profesor::create([
            'id_usuario' => $user->id_users,
            'tipo_documento' => 'CC',
            'documento_profesor' => '123456789',
            'nombres_profesor' => 'Ana',
            'apellidos_profesor' => 'García',
            'telefono_profesor' => '3001234567',
            'correo_profesor' => 'ana@salvatore.edu',
            'direccion_residencia' => 'Calle 1',
            'fecha_ingreso_colegio' => '2024-01-15',
            'tipo_contra' => 'Planta',
            'estado_profesor' => 'Activo',
        ]);

        $this->actingAs($user);

        Livewire::test('pages::settings.profile')
            ->assertSee('Datos personales')
            ->assertSee('Ana García')
            ->assertSee('CC 123456789')
            ->assertSee('Datos de contacto')
            ->assertSee('3001234567')
            ->assertSee('Datos laborales')
            ->assertSee('Tipo de vinculación')
            ->assertSee('Planta');
    }

    public function test_student_profile_displays_academic_and_guardian_information(): void
    {
        $user = User::factory()->create(['role' => 'Estudiante']);
        Institucion::create([
            'nit' => '900123456',
            'nombre_institucion' => 'Institución Salvatore',
            'direccion_principal' => 'Carrera 1',
        ]);
        $sede = Sede::create([
            'nit' => '900123456',
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
        $acudiente = Acudiente::create([
            'tipo_documento' => 'CC',
            'documento_identidad' => '987654321',
            'nombres_acudiente' => 'Carlos',
            'apellidos_acudiente' => 'Pérez',
            'genero' => 'Masculino',
            'parentesco_estudiante' => 'Padre',
            'telefono_acudiente' => '3109876543',
            'correo_acudiente' => 'carlos@example.com',
            'ocupacion' => 'Comerciante',
        ]);
        Estudiante::create([
            'id_usuario' => $user->id_users,
            'id_curso' => $curso->id_curso,
            'id_acudiente' => $acudiente->id_acudiente,
            'tipo_documento' => 'TI',
            'documento_identidad' => '100200300',
            'nombres_estudiante' => 'Lucía',
            'apellidos_estudiante' => 'Pérez',
            'fecha_nacimiento' => '2015-05-10',
            'genero' => 'Femenino',
            'tipo_sangre' => 'O+',
            'eps' => 'Salud',
            'estado_estudiante' => 'Activo',
        ]);

        $this->actingAs($user);

        Livewire::test('pages::settings.profile')
            ->assertSee('Datos personales')
            ->assertSee('Lucía Pérez')
            ->assertSee('TI 100200300')
            ->assertSee('Fecha de nacimiento')
            ->assertSee('Sexo')
            ->assertSee('Datos académicos')
            ->assertSee('5A')
            ->assertSee('Quinto')
            ->assertSee('Sede principal')
            ->assertSee('Contacto familiar')
            ->assertSee('Carlos Pérez')
            ->assertSee('Comerciante');
    }

    public function test_profile_explains_when_a_role_record_is_not_linked_to_the_account(): void
    {
        $user = User::factory()->create(['role' => 'Profesor']);

        $this->actingAs($user);

        Livewire::test('pages::settings.profile')
            ->assertSee('Esta cuenta no tiene una ficha de profesor vinculada.')
            ->assertSee('La institución debe asociar esta cuenta con el registro correspondiente.')
            ->assertSee('Documento de identidad')
            ->assertSee('Sin registrar');
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('pages::settings.profile')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->call('updateProfileInformation');

        $response->assertHasNoErrors();

        $user->refresh();

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('pages::settings.profile')
            ->set('name', 'Test User')
            ->set('email', $user->email)
            ->call('updateProfileInformation');

        $response->assertHasNoErrors();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('pages::settings.delete-user-modal')
            ->set('password', 'password')
            ->call('deleteUser');

        $response
            ->assertHasNoErrors()
            ->assertRedirect('/');

        $this->assertNull($user->fresh());
        $this->assertFalse(auth()->check());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = Livewire::test('pages::settings.delete-user-modal')
            ->set('password', 'wrong-password')
            ->call('deleteUser');

        $response->assertHasErrors(['password']);

        $this->assertNotNull($user->fresh());
    }
}
