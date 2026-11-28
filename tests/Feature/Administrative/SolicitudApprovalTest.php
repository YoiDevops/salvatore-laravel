<?php

namespace Tests\Feature\Administrative;

use App\Mail\SolicitudAprobada;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SolicitudApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_details_show_the_submitted_information_and_receipt_date(): void
    {
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->get(route('administrativo.solicitudes.index'));

        $response->assertOk();
        $response->assertSee('Ver detalle');
        $response->assertSee('Fecha de solicitud');
        $response->assertSee('987654321');
        $response->assertSee('acudiente@example.test');
        $response->assertSee('Empresa de prueba');
        $response->assertSee($solicitud->created_at->format('d/m/Y H:i'));
        $response->assertSee('Asignación académica');

        $allRequestsResponse = $this->actingAs($administrator)->get(route('administrativo.archivos-excel.index'));

        $allRequestsResponse->assertOk();
        $allRequestsResponse->assertSee('987654321');
        $allRequestsResponse->assertSee('acudiente@example.test');
        $allRequestsResponse->assertSee('Empresa de prueba');
    }

    public function test_approval_creates_student_account_and_sends_temporary_access_details(): void
    {
        Mail::fake();
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO],
        );

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $usuario = User::query()->where('email', 'acudiente@example.test')->firstOrFail();
        $this->assertSame('Estudiante', $usuario->effective_role);
        $this->assertSame('Activo', $usuario->status);
        $this->assertSame($usuario->id_users, $solicitud->fresh()->id_usuario);
        $this->assertDatabaseHas('solicitudes', [
            'id_solicitud' => $solicitud->id_solicitud,
            'estado' => Solicitud::ESTADO_APROBADO,
            'id_usuario' => $usuario->id_users,
        ]);

        $correoEnviado = null;
        Mail::assertSent(SolicitudAprobada::class, function (SolicitudAprobada $mail) use (&$correoEnviado): bool {
            $correoEnviado = $mail;

            return $mail->hasTo('acudiente@example.test');
        });

        $this->assertNotNull($correoEnviado);
        $this->assertNotEmpty($correoEnviado->contrasenaTemporal);
        $this->assertTrue(Hash::check($correoEnviado->contrasenaTemporal, $usuario->password));
        $this->assertStringContainsString($correoEnviado->contrasenaTemporal, $correoEnviado->render());
        $this->assertStringContainsString('Documento para ingresar:', $correoEnviado->render());
        $this->assertStringContainsString('123456789', $correoEnviado->render());
        $this->assertStringContainsString('Tu cuenta ya está activa', $correoEnviado->render());
        $this->assertStringContainsString('asignación académica está pendiente', $correoEnviado->render());

        $this->post(route('logout'));
        $this->post(route('login.store'), [
            'email' => '123456789',
            'password' => $correoEnviado->contrasenaTemporal,
        ])->assertSessionHasNoErrors()
            ->assertRedirect(route('estudiante.dashboard', absolute: false));
        $this->assertAuthenticatedAs($usuario);

        $this->post(route('logout'));
        $this->post(route('login.store'), [
            'email' => 'acudiente@example.test',
            'password' => $correoEnviado->contrasenaTemporal,
        ])->assertSessionHasErrorsIn('email');
        $this->assertGuest();
    }

    public function test_mail_failure_keeps_the_approved_account_and_shows_an_administrator_warning(): void
    {
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();
        Mail::shouldReceive('to')
            ->once()
            ->with('acudiente@example.test')
            ->andReturn(new class
            {
                public function send(SolicitudAprobada $mail): void
                {
                    throw new \RuntimeException('Mail transport unavailable.');
                }
            });

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO],
        );

        $response->assertRedirect();
        $response->assertSessionHas('warning');
        $this->assertSame(Solicitud::ESTADO_APROBADO, $solicitud->fresh()->estado);
        $this->assertDatabaseHas('users', ['email' => 'acudiente@example.test', 'estado' => 'Activo']);
    }

    public function test_student_account_is_committed_with_its_role_before_the_approval_email_is_sent(): void
    {
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();
        Mail::shouldReceive('to')
            ->once()
            ->with('acudiente@example.test')
            ->andReturn(new class(DB::transactionLevel())
            {
                public function __construct(private int $transactionLevel) {}

                public function send(SolicitudAprobada $mail): void
                {
                    if (DB::transactionLevel() !== $this->transactionLevel) {
                        throw new \RuntimeException('The account transaction is still open.');
                    }

                    $usuario = User::query()->findOrFail($mail->usuario->id_users);
                    if ($usuario->effective_role !== 'Estudiante' || $usuario->status !== 'Activo') {
                        throw new \RuntimeException('The student account is not committed with its role.');
                    }
                }
            });

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO],
        );

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_denied_request_does_not_create_an_account_or_send_email(): void
    {
        Mail::fake();
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_DENEGADO],
        );

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertSame(Solicitud::ESTADO_DENEGADO, $solicitud->fresh()->estado);
        $this->assertDatabaseMissing('users', ['email' => 'acudiente@example.test']);
        Mail::assertNothingSent();
    }

    public function test_approval_reuses_existing_student_account_and_sends_a_new_temporary_password(): void
    {
        Mail::fake();
        $administrator = User::factory()->admin()->create();
        $usuario = User::factory()->estudiante()->create([
            'email' => 'acudiente@example.test',
            'role' => 'Estudiante',
            'status' => 'Inactivo',
            'estado' => 'Inactivo',
        ]);
        $passwordOriginal = $usuario->password;
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO],
        );

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertNotSame($passwordOriginal, $usuario->fresh()->password);
        $this->assertSame('Activo', $usuario->fresh()->status);
        $this->assertSame($usuario->id_users, $solicitud->fresh()->id_usuario);

        Mail::assertSent(SolicitudAprobada::class, function (SolicitudAprobada $mail) use ($usuario): bool {
            return $mail->hasTo('acudiente@example.test')
                && $mail->contrasenaTemporal !== ''
                && Hash::check($mail->contrasenaTemporal, $usuario->fresh()->password);
        });
    }

    public function test_approval_does_not_overwrite_an_account_with_another_role(): void
    {
        Mail::fake();
        $administrator = User::factory()->admin()->create();
        User::factory()->profesor()->create([
            'email' => 'acudiente@example.test',
            'role' => 'Profesor',
        ]);
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO],
        );

        $response->assertRedirect();
        $response->assertSessionHasErrors('solicitud');
        $this->assertSame(Solicitud::ESTADO_EN_ESPERA, $solicitud->fresh()->estado);
        Mail::assertNothingSent();
    }

    public function test_enrollment_approval_rejects_roles_other_than_student(): void
    {
        Mail::fake();
        $administrator = User::factory()->admin()->create();
        $solicitud = $this->crearSolicitud();

        $response = $this->actingAs($administrator)->patch(
            route('administrativo.solicitudes.estado', $solicitud),
            ['estado' => Solicitud::ESTADO_APROBADO, 'role' => 'Profesor'],
        );

        $response->assertRedirect();
        $response->assertSessionHasErrors('role');
        $this->assertSame(Solicitud::ESTADO_EN_ESPERA, $solicitud->fresh()->estado);
        $this->assertDatabaseMissing('users', ['email' => 'acudiente@example.test']);
        Mail::assertNothingSent();
    }

    private function crearSolicitud(): Solicitud
    {
        return Solicitud::create([
            'estudiante_tipo_documento' => 'TI',
            'estudiante_numero_documento' => '123456789',
            'estudiante_nombres' => 'Estudiante',
            'estudiante_apellidos' => 'Prueba',
            'estudiante_fecha_nacimiento' => '2010-01-01',
            'estudiante_genero' => 'Masculino',
            'estudiante_tipo_sangre' => 'O+',
            'estudiante_lugar_nacimiento' => 'Bogotá',
            'estudiante_eps' => 'EPS de prueba',
            'estudiante_estado' => 'Activo',
            'estudiante_tiene_discapacidad' => 'No',
            'estudiante_tipo_discapacidad' => null,
            'estudiante_diagnostico_discapacidad' => null,
            'estudiante_grado_discapacidad' => null,
            'estudiante_permanencia_discapacidad' => null,
            'estudiante_grado_atencion' => null,
            'acudiente_tipo_documento' => 'CC',
            'acudiente_numero_documento' => '987654321',
            'acudiente_nombres' => 'Acudiente',
            'acudiente_apellidos' => 'Prueba',
            'acudiente_fecha_nacimiento' => '1980-01-01',
            'acudiente_genero' => 'Femenino',
            'acudiente_parentesco' => 'Madre',
            'acudiente_direccion' => 'Calle de prueba',
            'acudiente_telefono' => '3000000000',
            'acudiente_correo' => 'acudiente@example.test',
            'acudiente_lugar_trabajo' => 'Empresa de prueba',
            'acudiente_ocupacion' => 'Docente',
            'estado' => Solicitud::ESTADO_EN_ESPERA,
        ]);
    }
}
