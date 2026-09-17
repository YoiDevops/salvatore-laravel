@php
    $title    = 'Sedes';
    $resource = 'sedes';
    $items    = $sedes;
    $columns  = [
        ['nombre_sede','Sede'],
        ['institucion.nombre_institucion','Institución'],
        ['direccion_sede','Dirección'],
        ['telefono_sede','Teléfono'],
    ];
@endphp

@include('crud.index')
