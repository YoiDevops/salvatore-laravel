@php
    $listaInstituciones = $instituciones->pluck('nombre_institucion', 'nit');

    $title    = 'Editar sede';
    $resource = 'sedes';
    $item     = $sede;
    $method   = 'PUT';
    $action   = route('sedes.update', $sede->getKey());

    $fields = [
        ['nit','Institución','select',true,$listaInstituciones],
        ['nombre_sede','Nombre de la sede','text',true],
        ['direccion_sede','Dirección','text',false],
        ['telefono_sede','Teléfono','text',false],
    ];
@endphp

@include('crud.form')
