<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ColombiaLocationsTest extends TestCase
{
    public function test_birthplace_can_be_selected_by_department_and_municipality(): void
    {
        Cache::forget('colombia.departments');
        Cache::forget('colombia.department.4.municipalities');

        Http::fake([
            'https://api-colombia.com/api/v1/Department' => Http::response([
                ['id' => 4, 'name' => 'Atlántico'],
            ]),
            'https://api-colombia.com/api/v1/Department/4/cities' => Http::response([
                ['id' => 144, 'name' => 'Barranquilla'],
            ]),
        ]);

        Livewire::test('formulario')
            ->assertSee('Atlántico')
            ->set('estudiante_departamento', '4')
            ->assertSee('Barranquilla')
            ->set('estudiante_municipio', '144')
            ->assertSet('estudiante_lugar_nacimiento', 'Barranquilla, Atlántico');
    }
}
