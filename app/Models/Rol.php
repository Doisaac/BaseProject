<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class);
    }
}