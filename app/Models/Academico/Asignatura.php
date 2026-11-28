<?php

namespace App\Models\Academico;

use App\Models\Evaluacion\IndicadorLogro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /** @return BelongsTo<Area, $this> */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    /** @return HasMany<IndicadorLogro, $this> */
    public function indicadoresLogro(): HasMany
    {
        return $this->hasMany(IndicadorLogro::class, 'id_asignatura', 'id_asignatura');
    }

    /** @return HasMany<Carga, $this> */
    public function cargas(): HasMany
    {
        return $this->hasMany(Carga::class, 'id_asignatura', 'id_asignatura');
    }
}
