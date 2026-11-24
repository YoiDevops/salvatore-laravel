<?php

namespace Tests\Feature;

use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormularioCorreoTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_username_is_combined_with_selected_domain_before_validation(): void
    {
        foreach ([
            ['gmail.com', '', 'contacto@gmail.com'],
            ['hotmail.com', '', 'contacto@hotmail.com'],
            ['otro', 'colegio.edu.co', 'contacto@colegio.edu.co'],
            ['otro', '@colegio.edu.co', 'contacto@colegio.edu.co'],
        ] as [$domain, $otherDomain, $email]) {
            Livewire::test('formulario')
                ->set('acudiente_tipo_documento', 'CC')
                ->set('acudiente_numero_documento', '12345678')
                ->set('acudiente_nombres', 'Ana')
                ->set('acudiente_apellidos', 'Gomez')
                ->set('acudiente_fecha_nacimiento', '1990-01-01')
                ->set('acudiente_genero', 'Femenino')
                ->set('acudiente_parentesco', 'Madre')
                ->set('acudiente_direccion', 'Calle 1')
                ->set('acudiente_telefono', '3001234567')
                ->set('acudientecontacto_usuario', 'contacto')
                ->set('acudientecontacto_dominio', $domain)
                ->set('acudientecontacto_otro_dominio', $otherDomain)
                ->set('estudiante_tipo_documento', 'TI')
                ->set('estudiante_numero_documento', '87654321')
                ->set('estudiante_nombres', 'Luis')
                ->set('estudiante_apellidos', 'Perez')
                ->set('estudiante_fecha_nacimiento', '2015-01-01')
                ->set('estudiante_genero', 'Masculino')
                ->set('estudiante_tipo_sangre', 'O+')
                ->set('estudiante_lugar_nacimiento', 'Bogota, Cundinamarca')
                ->set('estudiante_eps', 'Nueva EPS')
                ->set('estudiante_tiene_discapacidad', 'No')
                ->call('guardarAcudiente')
                ->assertHasNoErrors()
                ->assertSet('acudientecontacto_correo', $email)
                ->assertSet('registroCompletado', true);
        }
    }
}
