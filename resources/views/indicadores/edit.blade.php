@php
    $listaAsignaturas = $asignaturas->pluck('nombre_asignatura', 'id_asignatura');
    $listaPeriodos    = $periodos->pluck('nombre_periodo', 'id_periodo');
    $listaEscalas     = $escalas->mapWithKeys(fn($e) => [
        $e->id_escala => $e->nombre_desempeno.' ('.$e->nota_minima.' - '.$e->nota_maxima.')'
    ]);

    $title    = 'Editar indicador';
    $resource = 'indicadores';
    $item     = $indicador;
    $method   = 'PUT';
    $action   = route('indicadores.update', $indicador->getKey());

    $fields = [
        ['id_asignatura','Asignatura','select',true,$listaAsignaturas],
        ['id_periodo','Periodo','select',true,$listaPeriodos],
        ['id_escala','Escala de valoración','select',true,$listaEscalas],
        ['codigo_logro','Código','text',false],
        ['descripcion_logro','Descripción','textarea',true],
        ['tipo_logro','Tipo','select',false,['Cognitivo'=>'Cognitivo','Procedimental'=>'Procedimental','Actitudinal'=>'Actitudinal']],
    ];
@endphp

@include('crud.form')
