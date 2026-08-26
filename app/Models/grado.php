<?php

namespace App\Models;

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
        'edad_minima',
        'edad_maxima',
        'ano_lectivo', 
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_grado', 'id_grado');
    }
}