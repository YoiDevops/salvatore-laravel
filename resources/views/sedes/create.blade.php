@php
    $listaInstituciones = $instituciones->pluck('nombre_institucion', 'nit');

    $title    = 'Nueva sede';
    $resource = 'sedes';
    $item     = null;
    $method   = null;
    $action   = route('sedes.store');

    $fields = [
        ['nit','Institución','select',true,$listaInstituciones],
        ['nombre_sede','Nombre de la sede','text',true],
        ['direccion_sede','Dirección','text',false],
        ['telefono_sede','Teléfono','text',false],
    ];
@endphp

@include('crud.form')
