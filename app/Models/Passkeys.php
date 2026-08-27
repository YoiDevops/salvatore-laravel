<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passkey extends Model
{
    protected $table = 'passkeys';
    protected $primaryKey = 'id';

    protected $guarded = [];
}  