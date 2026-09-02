<?php

namespace App\Models\Usuarios;

use App\Models\Estudiante\Estudiante;
use App\Models\Profesor\Profesor;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Passkeys\Contracts\PasskeyUser;
use Laravel\Passkeys\Passkey;
use Laravel\Passkeys\PasskeyAuthenticatable;

#[Fillable(['name', 'email', 'password', 'nom_rol', 'estado'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    public $incrementing = true;
    protected $keyType = 'int';

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function getAuthIdentifierName(): string
    {
        return 'id_users';
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_users'] ?? $this->id_users;
    }

    public function getKey()
    {
        return $this->attributes['id_users'] ?? parent::getKey();
    }

    /**
     * Relación con las passkeys cumpliendo la clave personalizada id_users.
     */
    public function passkeys(): HasMany
    {
        return $this->hasMany(Passkey::class, 'id_users', 'id_users');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function initials(): string
    {
        $initials = Str::initials($this->name, true);

        return Str::length($initials) > 1
            ? Str::substr($initials, 0, 1).Str::substr($initials, -1)
            : $initials;
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_usuario', 'id_users');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'id_usuario', 'id_users');
    }
}