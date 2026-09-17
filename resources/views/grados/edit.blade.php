@php
    $title    = 'Editar grado';
    $resource = 'grados';
    $item     = $grado;
    $method   = 'PUT';
    $action   = route('grados.update', $grado->getKey());

    $fields = [
        ['nombre_grado','Nombre del grado','select',true,[
            'Transición'=>'Transición','Primero'=>'Primero','Segundo'=>'Segundo','Tercero'=>'Tercero',
            'Cuarto'=>'Cuarto','Quinto'=>'Quinto','Sexto'=>'Sexto','Séptimo'=>'Séptimo',
            'Octavo'=>'Octavo','Noveno'=>'Noveno','Décimo'=>'Décimo','Undécimo'=>'Undécimo',
        ]],
    ];
@endphp

@include('crud.form')
