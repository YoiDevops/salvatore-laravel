<?php

namespace App\Models\Estudiante;

use App\Models\Academico\Curso;
use App\Models\Estudiante\Acudiente;
use App\Models\Estudiante\CaracterizacionDiscapacidad;
use App\Models\Usuarios\User;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'id_estudiante';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_curso',
        'id_acudiente',
        'id_caracterizacion',
        'tipo_documento',
        'documento_identidad',
        'nombres_estudiante',
        'apellidos_estudiante',
        'fecha_nacimiento',
        'genero',
        'tipo_sangre',
        'lugar_nacimiento',
        'eps',
        'estado_estudiante',
    ];

    // Nota: la migración no declara ->foreign() para id_usuario,
    // pero la relación lógica con la tabla users existe.
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_users');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }

    public function acudiente()
    {
        return $this->belongsTo(Acudiente::class, 'id_acudiente', 'id_acudiente');
    }

    public function caracterizacion()
    {
        return $this->belongsTo(CaracterizacionDiscapacidad::class, 'id_caracterizacion', 'id_caracterizacion');
    }
}
