@php
    $title    = 'Nuevo rol';
    $resource = 'roles';
    $item     = null;
    $method   = null;
    $action   = route('roles.store');

    $fields = [
        ['nombre_rol','Nombre del rol','select',true,[
            'Administrador'=>'Administrador','Profesor'=>'Profesor','Estudiante'=>'Estudiante',
            'Administrativo'=>'Administrativo','Invitado'=>'Invitado',
        ]],
    ];
@endphp

@include('crud.form')
