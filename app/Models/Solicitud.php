<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    public const ESTADO_EN_ESPERA = 'en espera';

    public const ESTADO_APROBADO = 'aprobado';

    public const ESTADO_DENEGADO = 'denegado';

    public const ESTADOS = [
        self::ESTADO_EN_ESPERA,
        self::ESTADO_APROBADO,
        self::ESTADO_DENEGADO,
    ];

    protected $table = 'solicitudes';

    protected $primaryKey = 'id_solicitud';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['estudiante_fecha_nacimiento' => 'date', 'acudiente_fecha_nacimiento' => 'date'];
    }
}
