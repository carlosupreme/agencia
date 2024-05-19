<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{

    protected $fillable = ['user_id', 'numero', 'nombre'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alquileresPagados()
    {
        return $this->hasMany(Alquiler::class);
    }
}
