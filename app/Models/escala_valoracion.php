<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscalaValoracion extends Model
{
    protected $table = 'escala_valoracion';
    protected $primaryKey = 'id_escala';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_desempeno',
        'nota_minima',
        'nota_maxima',
        'definicion_escala',
    ];

    public function indicadoresLogro()
    {
        return $this->hasMany(IndicadorLogro::class, 'id_escala', 'id_escala');
    }
}
