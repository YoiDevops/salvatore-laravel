<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesor';
    protected $primaryKey = 'id_profesor';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'tipo_documento',
        'documento_profesor',
        'nombres_profesor',
        'apellidos_profesor',
        'telefono_profesor',
        'correo_profesor',
        'direccion_residencia',
        'fecha_ingreso_colegio',
        'tipo_contra', 
        'estado_profesor',
    ];

  
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_users');
    }
}