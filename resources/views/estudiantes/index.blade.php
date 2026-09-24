@php
    $title    = 'Estudiantes';
    $resource = 'estudiantes';
    $items    = $estudiantes;
    $columns  = [
        ['documento_identidad','Documento'],
        ['nombres_estudiante','Nombres'],
        ['apellidos_estudiante','Apellidos'],
        ['curso.nombre_curso','Curso'],
        ['acudiente.nombres_acudiente','Acudiente'],
        ['estado_estudiante','Estado'],
    ];
    $filterFields = [
        ['name' => 'curso', 'label' => 'Curso', 'options' => $cursos->pluck('nombre_curso', 'id_curso')->all()],
        ['name' => 'genero', 'label' => 'Género', 'options' => ['Femenino' => 'Femenino', 'Masculino' => 'Masculino', 'Otro' => 'Otro']],
        ['name' => 'grado', 'label' => 'Grado', 'options' => $grados->pluck('nombre_grado', 'id_grado')->all()],
        ['name' => 'filter', 'label' => 'Estado', 'options' => ['Activo' => 'Activo', 'Retirado' => 'Retirado', 'Graduado' => 'Graduado', 'Suspendido' => 'Suspendido']],
    ];
@endphp

@include('crud.index')
