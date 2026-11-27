<?php

namespace App\Models\Evaluacion;

use App\Models\Academico\Asignatura;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /** @return BelongsTo<Asignatura, $this> */
    public function asignatura(): BelongsTo
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura', 'id_asignatura');
    }

    /** @return BelongsTo<Periodo, $this> */
    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'id_periodo');
    }

    /** @return BelongsTo<EscalaValoracion, $this> */
    public function escalaValoracion(): BelongsTo
    {
        return $this->belongsTo(EscalaValoracion::class, 'id_escala', 'id_escala');
    }

    /** @return HasMany<Calificacion, $this> */
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class, 'id_indicador', 'id_indicador');
    }
}
