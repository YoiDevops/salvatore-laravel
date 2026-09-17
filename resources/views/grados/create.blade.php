@php
    $title    = 'Nuevo grado';
    $resource = 'grados';
    $item     = null;
    $method   = null;
    $action   = route('grados.store');

    // La tabla grado solo tiene nombre_grado
    $fields = [
        ['nombre_grado','Nombre del grado','select',true,[
            'Transición'=>'Transición','Primero'=>'Primero','Segundo'=>'Segundo','Tercero'=>'Tercero',
            'Cuarto'=>'Cuarto','Quinto'=>'Quinto','Sexto'=>'Sexto','Séptimo'=>'Séptimo',
            'Octavo'=>'Octavo','Noveno'=>'Noveno','Décimo'=>'Décimo','Undécimo'=>'Undécimo',
        ]],
    ];
@endphp

@include('crud.form')
