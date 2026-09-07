<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
}