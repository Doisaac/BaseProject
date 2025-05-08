<?php

namespace App\Policies;

use App\Models\Vehiculo;
use App\Models\Usuario; // Importar la clase Usuario desde App\Models
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiculoPolicy
{
    use HandlesAuthorization;

    public function view(Usuario $usuario)
    {
        return $usuario->hasRole('admin') || $usuario->hasRole('usuario');
    }

    public function create(Usuario $usuario)
    {
        return $usuario->hasRole('admin'); // Variable usuario en lugar de user
    }

    public function update(Usuario $usuario)
    {
        return $usuario->hasRole('admin'); // Variable usuario en lugar de user
    }

    public function delete(Usuario $usuario)
    {
        return $usuario->hasRole('admin'); // Variable usuario en lugar de user
    }
}