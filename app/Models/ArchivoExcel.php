<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoExcel extends Model
{
    protected $table = 'archivos_excel';
    protected $primaryKey = 'id_archivo_excel';
    protected $guarded = [];
}
