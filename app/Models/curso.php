<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id_curso';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_sede',
        'id_grado',
        'nombre_curso',
        'cupo_maximo',
        'jornada',
        'ano_lectivo', 
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado', 'id_grado');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_curso', 'id_curso');
    }
}
