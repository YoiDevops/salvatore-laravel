@php
    $title    = 'Editar profesor';
    $resource = 'profesores';
    $item     = $profesor;
    $method   = 'PUT';
    $action   = route('profesores.update', $profesor->getKey());

    $fields = [
        ['tipo_documento','Tipo de documento','select',true,['CC'=>'CC','CE'=>'CE','PASAPORTE'=>'Pasaporte','PPT'=>'PPT']],
        ['documento_profesor','Documento','text',true],
        ['nombres_profesor','Nombres','text',true],
        ['apellidos_profesor','Apellidos','text',true],
        ['telefono_profesor','Teléfono','text',false],
        ['correo_profesor','Correo personal','email',false],
        ['direccion_residencia','Dirección de residencia','text',false],
        ['fecha_ingreso_colegio','Fecha de ingreso','date',false],
        ['tipo_contra','Tipo de contrato','select',false,[
            'Planta'=>'Planta','Provisional'=>'Provisional','Prestación de servicios'=>'Prestación de servicios',
        ]],
        ['estado_profesor','Estado','select',false,['Activo'=>'Activo','Inactivo'=>'Inactivo','Licencia'=>'Licencia']],
    ];
@endphp

@include('crud.form')
