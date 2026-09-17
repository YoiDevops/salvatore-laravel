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
@endphp

@include('crud.index')
