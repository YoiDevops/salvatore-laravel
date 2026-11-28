<?php

namespace App\Models\Academico;

use App\Models\Profesor\Profesor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carga extends Model
{
    protected $table = 'carga_academica';

    protected $primaryKey = 'id_carga';

    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'id_asignatura',
        'id_profesor',
        'intensidad_horaria',
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }

    public function asignatura(): BelongsTo
    {
        return $this->belongsTo(Asignatura::class, 'id_asignatura', 'id_asignatura');
    }

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class, 'id_profesor', 'id_profesor');
    }
}
