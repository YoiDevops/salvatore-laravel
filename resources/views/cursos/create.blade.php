@php
    $listaSedes  = $sedes->pluck('nombre_sede', 'id_sede');
    $listaGrados = $grados->pluck('nombre_grado', 'id_grado');

    $title    = 'Nuevo curso';
    $resource = 'cursos';
    $item     = null;
    $method   = null;
    $action   = route('cursos.store');

    $fields = [
        ['nombre_curso','Nombre del curso','text',true],
        ['id_grado','Grado','select',true,$listaGrados],
        ['id_sede','Sede','select',true,$listaSedes],
        ['cupo_maximo','Cupo máximo','number',true],
        ['jornada','Jornada','select',false,['Mañana'=>'Mañana','Tarde'=>'Tarde','Noche'=>'Noche','Única'=>'Única']],
        ['ano_lectivo','Año lectivo','text',false],
    ];
@endphp

@include('crud.form')
