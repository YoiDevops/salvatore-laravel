@php
    $title    = 'Editar periodo';
    $resource = 'periodos';
    $item     = $periodo;
    $method   = 'PUT';
    $action   = route('periodos.update', $periodo->getKey());

    $fields = [
        ['nombre_periodo','Nombre del periodo','select',true,[
            'Primer periodo'=>'Primer periodo','Segundo periodo'=>'Segundo periodo',
            'Tercer periodo'=>'Tercer periodo','Cuarto periodo'=>'Cuarto periodo',
        ]],
        ['porcentaje_periodo','Porcentaje (%)','number',true],
        ['anio_lectivo','Año lectivo','number',true],
        ['fecha_inicio','Fecha de inicio','date',true],
        ['fecha_cierre','Fecha de cierre','date',true],
    ];
@endphp

@include('crud.form')
