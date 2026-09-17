@php
    $title    = 'Detalle de indicador';
    $resource = 'indicadores';
    $item     = $indicador;
    $columns  = [
        ['codigo_logro','Código'],
        ['asignatura.nombre_asignatura','Asignatura'],
        ['periodo.nombre_periodo','Periodo'],
        ['escalaValoracion.nombre_desempeno','Desempeño'],
        ['descripcion_logro','Descripción'],
        ['tipo_logro','Tipo'],
    ];
@endphp

@include('crud.show')
