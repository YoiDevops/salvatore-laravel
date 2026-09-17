@php
    $listaAreas = $areas->pluck('nombre_area', 'id_area');

    $title    = 'Nueva asignatura';
    $resource = 'asignaturas';
    $item     = null;
    $method   = null;
    $action   = route('asignaturas.store');

    $fields = [
        ['nombre_asignatura','Nombre de la asignatura','text',true],
        ['id_area','Área académica','select',true,$listaAreas],
        ['intensidad_horaria','Intensidad horaria semanal','number',true],
        ['porcentaje_area','Porcentaje dentro del área (%)','number',false],
        ['descripcion','Descripción','textarea',false],
    ];
@endphp

@include('crud.form')
