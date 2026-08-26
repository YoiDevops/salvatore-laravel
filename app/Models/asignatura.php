<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignatura';
    protected $primaryKey = 'id_asignatura';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_area',
        'nombre_asignatura',
        'intensidad_horaria',
        'porcentaje_area',
        'descripcion',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    public function indicadoresLogro()
    {
        return $this->hasMany(IndicadorLogro::class, 'id_asignatura', 'id_asignatura');
    }
}
