<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_successful_response(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Preguntas frecuentes');
        $response->assertSee('¿Cómo puedo iniciar una inscripción?');
        $response->assertSee('¿Cómo ingreso a mi cuenta?');
        $response->assertSee('¿Olvidé mi contraseña o usuario, qué hago?');
        $response->assertSee('id="preguntas-frecuentes"', false);
    }
}
