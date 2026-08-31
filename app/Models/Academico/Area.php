<?php

namespace App\Models\Academico;

use App\Models\Academico\Asignatura;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'id_area';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_area',
        'descripcion',
    ];

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'id_area', 'id_area');
    }
}
