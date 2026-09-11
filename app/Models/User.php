<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'nom_rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getIdAttribute(): mixed
    {
        return $this->getKey();
    }

    public function passkeys(): HasMany
    {
        return $this->hasMany(Passkey::class, 'id_users', 'id_users');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        $words = explode(' ', $this->name ?? '');
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            if (!empty($word)) {
                $initials .= mb_substr($word, 0, 1);
            }
        }

        return strtoupper($initials);
    }

    public function getEffectiveRoleAttribute(): string
    {
        $legacyRole = trim((string) $this->getRawOriginal('nom_rol'));
        $currentRole = trim((string) $this->getRawOriginal('role'));

        return $legacyRole !== '' && ($currentRole === '' || strtolower($currentRole) === 'usuario')
            ? $legacyRole
            : ($currentRole !== '' ? $currentRole : $legacyRole);
    }
}