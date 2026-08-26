<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaracterizacionDiscapacidad extends Model
{
    protected $table = 'caracterizacion_discapacidad';
    protected $primaryKey = 'id_caracterizacion';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipo_discapacidad',
        'diagnostico',
        'grado_discapacidad',
        'permanencia',
        'grado_atencion',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_caracterizacion', 'id_caracterizacion');
    }
}
