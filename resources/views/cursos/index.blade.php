@php
    $title    = 'Cursos';
    $resource = 'cursos';
    $items    = $cursos;
    $columns  = [
        ['nombre_curso','Curso'],
        ['grado.nombre_grado','Grado'],
        ['sede.nombre_sede','Sede'],
        ['jornada','Jornada'],
        ['cupo_maximo','Cupo'],
    ];
@endphp

@include('crud.index')
