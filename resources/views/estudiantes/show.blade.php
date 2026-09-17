@php
    $title    = 'Detalle de estudiante';
    $resource = 'estudiantes';
    $item     = $estudiante;
    $columns  = [
        ['documento_identidad','Documento'],
        ['nombres_estudiante','Nombres'],
        ['apellidos_estudiante','Apellidos'],
        ['fecha_nacimiento','Nacimiento'],
        ['genero','Género'],
        ['tipo_sangre','Tipo de sangre'],
        ['curso.nombre_curso','Curso'],
        ['curso.grado.nombre_grado','Grado'],
        ['acudiente.nombres_acudiente','Acudiente'],
        ['caracterizacion.tipo_discapacidad','Discapacidad'],
        ['usuario.email','Correo'],
        ['estado_estudiante','Estado'],
    ];
@endphp

@include('crud.show')
