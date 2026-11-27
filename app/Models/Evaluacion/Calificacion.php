<?php

namespace App\Models\Evaluacion;

use App\Models\Estudiante\Estudiante;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calificacion extends Model
{
    protected $table = 'calificacion';

    protected $primaryKey = 'id_calificacion';

    protected $fillable = [
        'id_estudiante',
        'id_indicador',
        'id_escala',
        'nota',
    ];

    protected function casts(): array
    {
        return [
            'nota' => 'decimal:2',
        ];
    }

    /** @return BelongsTo<Estudiante, $this> */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }

    /** @return BelongsTo<IndicadorLogro, $this> */
    public function indicador(): BelongsTo
    {
        return $this->belongsTo(IndicadorLogro::class, 'id_indicador', 'id_indicador');
    }

    /** @return BelongsTo<EscalaValoracion, $this> */
    public function escalaValoracion(): BelongsTo
    {
        return $this->belongsTo(EscalaValoracion::class, 'id_escala', 'id_escala');
    }
}
