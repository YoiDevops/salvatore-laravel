@php($title='Nuevo rol') @php($resource='roles') @php($item=null) @php($method=null) @php($action=route('roles.store')) @php($fields=[['nombre_rol','Nombre','text',true]]) @include('crud.form')
