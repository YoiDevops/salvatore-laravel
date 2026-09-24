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
    $filterFields = [
        ['name' => 'filter', 'label' => 'Jornada', 'options' => $jornadas->all()],
        ['name' => 'ano_lectivo', 'label' => 'Año lectivo', 'options' => $anios->all()],
    ];
@endphp

@include('crud.index')
