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
    $filterFields = [
        ['name' => 'periodo', 'label' => 'Periodo', 'options' => $periodos->pluck('nombre_periodo', 'id_periodo')->all()],
        ['name' => 'escala', 'label' => 'Escala', 'options' => $escalas->pluck('nombre_desempeno', 'id_escala')->all()],
    ];
@endphp

@include('crud.index')
