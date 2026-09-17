@php
    $title    = 'Editar rol';
    $resource = 'roles';
    $item     = $rol;
    $method   = 'PUT';
    $action   = route('roles.update', $rol->getKey());

    $fields = [
        ['nombre_rol','Nombre del rol','select',true,[
            'Administrador'=>'Administrador','Profesor'=>'Profesor','Estudiante'=>'Estudiante',
            'Administrativo'=>'Administrativo','Invitado'=>'Invitado',
        ]],
    ];
@endphp

@include('crud.form')
