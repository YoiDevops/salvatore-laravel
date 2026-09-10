<?php

namespace App\Models\Evaluacion;

use App\Models\Academico\Asignatura;
use Illuminate\Database\Eloquent\Model;

class IndicadorLogro extends Model
{
    protected $table = 'indicador_logro';
    protected $primaryKey = 'id_indicador';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_asignatura',
        'id_periodo',
        'id_escala',
        'codigo_logro',
        'descripcion_logro',
        'tipo_logro',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura', 'id_asignatura');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id_periodo');
    }

    public function escalaValoracion()
    {
        return $this->belongsTo(EscalaValoracion::class, 'id_escala', 'id_escala');
    }
}
