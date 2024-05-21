<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Vehiculo extends Model
{
    protected $fillable = ['marca', 'modelo', 'placas', 'categoria_id', 'foto', 'precio_dia', 'activo'];

    protected $appends = [
        'photo_url',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function deleteProfilePhoto()
    {
        if (is_null($this->foto)) return;

        Storage::disk('public')->delete($this->profile_photo_path);

        $this->forceFill([
            'foto' => null,
        ])->save();
    }

    public function photoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->foto
                    ? Storage::disk('public')->url($this->foto)
                    : '/car_default.jpeg';
        });
    }
}
