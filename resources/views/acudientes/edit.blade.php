@php
    $title    = 'Editar acudiente';
    $resource = 'acudientes';
    $item     = $acudiente;
    $method   = 'PUT';
    $action   = route('acudientes.update', $acudiente->getKey());

    $fields = [
        ['tipo_documento','Tipo de documento','select',true,['CC'=>'CC','TI'=>'TI','CE'=>'CE','PASAPORTE'=>'Pasaporte','PEP'=>'PEP','PPT'=>'PPT']],
        ['documento_identidad','Documento','text',true],
        ['nombres_acudiente','Nombres','text',true],
        ['apellidos_acudiente','Apellidos','text',true],
        ['fecha_nacimiento','Fecha de nacimiento','date',false],
        ['genero','Género','select',true,['Masculino'=>'Masculino','Femenino'=>'Femenino','Otro'=>'Otro']],
        ['parentesco_estudiante','Parentesco con el estudiante','select',true,[
            'Padre'=>'Padre','Madre'=>'Madre','Tío/a'=>'Tío/a','Abuelo/a'=>'Abuelo/a',
            'Hermano/a'=>'Hermano/a','Tutor legal'=>'Tutor legal','Otro'=>'Otro',
        ]],
        ['telefono_acudiente','Teléfono','text',false],
        ['correo_acudiente','Correo','email',false],
        ['direccion_residencia','Dirección de residencia','text',false],
        ['lugar_trabajo','Lugar de trabajo','text',false],
        ['ocupacion','Ocupación','text',false],
    ];
@endphp

@include('crud.form')
