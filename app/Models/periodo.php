<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    protected $primaryKey = 'id_periodo';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_periodo',
        'porcentaje_periodo',
        'anio_lectivo',
        'fecha_inicio',
        'fecha_cierre',
    ];

    public function indicadoresLogro()
    {
        return $this->hasMany(IndicadorLogro::class, 'id_periodo', 'id_periodo');
    }
}
