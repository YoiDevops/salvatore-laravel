@php
    $title    = 'Nueva escala';
    $resource = 'escalas';
    $item     = null;
    $method   = null;
    $action   = route('escalas.store');

    $fields = [
        ['nombre_desempeno','Desempeño','select',true,['Superior'=>'Superior','Alto'=>'Alto','Basico'=>'Básico','Bajo'=>'Bajo']],
        ['nota_minima','Nota mínima','number',true],
        ['nota_maxima','Nota máxima','number',true],
        ['definicion_escala','Definición','textarea',false],
    ];
@endphp

@include('crud.form')
