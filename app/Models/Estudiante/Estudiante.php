<?php

namespace App\Models\Estudiante;

use App\Models\Academico\Curso;
use App\Models\Evaluacion\Calificacion;
use App\Models\Usuarios\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    /** @return BelongsTo<User, $this> */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_users');
    }

    /** @return BelongsTo<Curso, $this> */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }

    /** @return BelongsTo<Acudiente, $this> */
    public function acudiente(): BelongsTo
    {
        return $this->belongsTo(Acudiente::class, 'id_acudiente', 'id_acudiente');
    }

    /** @return BelongsTo<CaracterizacionDiscapacidad, $this> */
    public function caracterizacion(): BelongsTo
    {
        return $this->belongsTo(CaracterizacionDiscapacidad::class, 'id_caracterizacion', 'id_caracterizacion');
    }

    /** @return HasMany<Calificacion, $this> */
    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class, 'id_estudiante', 'id_estudiante');
    }
}
