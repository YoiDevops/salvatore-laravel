<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id_solicitud';
    protected $guarded = [];

    protected function casts(): array
    {
        return ['estudiante_fecha_nacimiento' => 'date', 'acudiente_fecha_nacimiento' => 'date'];
    }
}
