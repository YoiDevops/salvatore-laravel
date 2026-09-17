@php
    $title    = 'Indicadores de logro';
    $resource = 'indicadores';
    $items    = $indicadores;
    $columns  = [
        ['codigo_logro','Código'],
        ['asignatura.nombre_asignatura','Asignatura'],
        ['periodo.nombre_periodo','Periodo'],
        ['escalaValoracion.nombre_desempeno','Desempeño'],
        ['descripcion_logro','Descripción'],
    ];
@endphp

@include('crud.index')
