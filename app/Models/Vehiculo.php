<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = ['marca', 'modelo', 'placas', 'categoria_id', 'foto', 'precio_dia'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
