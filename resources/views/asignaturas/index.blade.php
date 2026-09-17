@php
    $title    = 'Asignaturas';
    $resource = 'asignaturas';
    $items    = $asignaturas;
    $columns  = [
        ['nombre_asignatura','Asignatura'],
        ['area.nombre_area','Área'],
        ['intensidad_horaria','Horas'],
        ['porcentaje_area','% del área'],
    ];
@endphp

@include('crud.index')
