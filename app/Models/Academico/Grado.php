<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grado';
    protected $primaryKey = 'id_grado';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nombre_grado',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_grado', 'id_grado');
    }
}