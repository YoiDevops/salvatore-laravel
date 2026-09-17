@php
    $title    = 'Editar caracterización';
    $resource = 'caracterizaciones';
    $item     = $caracterizacion;
    $method   = 'PUT';
    $action   = route('caracterizaciones.update', $caracterizacion->getKey());

    $fields = [
        ['tipo_discapacidad','Tipo de discapacidad','text',true],
        ['diagnostico','Diagnóstico','textarea',false],
        ['grado_discapacidad','Grado de discapacidad','select',true,['Leve'=>'Leve','Moderada'=>'Moderada','Severa'=>'Severa']],
        ['permanencia','Permanencia','select',true,['Temporal'=>'Temporal','Permanente'=>'Permanente']],
        ['grado_atencion','Grado de atención','text',false],
    ];
@endphp

@include('crud.form')
