@php
    $title    = 'Nueva área';
    $resource = 'areas';
    $item     = null;
    $method   = null;
    $action   = route('areas.store');

    $fields = [
        ['nombre_area','Nombre del área','text',true],
        ['descripcion','Descripción','textarea',false],
    ];
@endphp

@include('crud.form')
