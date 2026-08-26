<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';
    protected $primaryKey = 'id_sede';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nit',
        'nombre_sede',
        'direccion_sede',
        'telefono_sede',
    ];

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'nit', 'nit');
    }

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'id_sede', 'id_sede');
    }
}
