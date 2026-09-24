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
    $filterFields = [['name' => 'area', 'label' => 'Área', 'options' => $areas->pluck('nombre_area', 'id_area')->all()]];
@endphp

@include('crud.index')
