<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucion';
    protected $primaryKey = 'nit';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nit',
        'nombre_institucion',
        'direccion_principal',
        'telefono_contacto',
        'correo_electronico',
        'registro_dane',
        'resolucion_aprobacion',
        'url_logo',
    ];

    public function sedes()
    {
        return $this->hasMany(Sede::class, 'nit', 'nit');
    }
}
