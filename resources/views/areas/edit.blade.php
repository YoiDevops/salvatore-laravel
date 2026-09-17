@php
    $title    = 'Editar área';
    $resource = 'areas';
    $item     = $area;
    $method   = 'PUT';
    $action   = route('areas.update', $area->getKey());

    $fields = [
        ['nombre_area','Nombre del área','text',true],
        ['descripcion','Descripción','textarea',false],
    ];
@endphp

@include('crud.form')
