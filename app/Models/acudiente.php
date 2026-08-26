<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
{
    protected $table = 'acudiente';
    protected $primaryKey = 'id_acudiente';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipo_documento',
        'documento_identidad',
        'nombres_acudiente',
        'apellidos_acudiente',
        'fecha_nacimiento',
        'genero',
        'parentesco_estudiante',
        'direccion_residencia',
        'telefono_acudiente',
        'correo_acudiente',
        'lugar_trabajo',
        'ocupacion',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_acudiente', 'id_acudiente');
    }
}
