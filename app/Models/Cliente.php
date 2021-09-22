<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $filable = ['nombre', 'apellidos', 'telefono', 'email', 'direccion', 'foto'];

    public function viajes()
    {
        return $this->hasMany(Viaje::class,'email', 'email');
    }
}
