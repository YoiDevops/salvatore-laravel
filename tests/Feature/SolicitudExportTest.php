<?php

namespace Tests\Feature;

use App\Http\Controllers\SolicitudController;
use App\Models\Solicitud;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SolicitudExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_marks_disability_fields_as_not_applicable_when_student_has_no_disability(): void
    {
        Solicitud::create([
            'estudiante_tiene_discapacidad' => 'No',
            'estudiante_tipo_discapacidad' => null,
            'estudiante_diagnostico_discapacidad' => null,
            'estudiante_grado_discapacidad' => null,
            'estudiante_permanencia_discapacidad' => null,
            'estudiante_grado_atencion' => null,
        ]);

        Solicitud::create([
            'estudiante_tiene_discapacidad' => 'Si',
            'estudiante_tipo_discapacidad' => 'Discapacidad fisica',
            'estudiante_diagnostico_discapacidad' => 'Diagnostico de prueba',
            'estudiante_grado_discapacidad' => 'Moderada',
            'estudiante_permanencia_discapacidad' => 'Permanente',
            'estudiante_grado_atencion' => 'Aula regular',
        ]);

        $response = app(SolicitudController::class)->exportStudents();
        ob_start();
        $response->sendContent();
        $csv = ob_get_clean();
        $rows = array_map(fn (string $row): array => str_getcsv($row, ';'), array_filter(explode("\n", trim($csv))));

        $this->assertSame(['No', 'No aplica', 'No aplica', 'No aplica', 'No aplica', 'No aplica'], array_slice($rows[1], 11, 6));
        $this->assertSame(['Si', 'Discapacidad fisica', 'Diagnostico de prueba', 'Moderada', 'Permanente', 'Aula regular'], array_slice($rows[2], 11, 6));
    }
}
