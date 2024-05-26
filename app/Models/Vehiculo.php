<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Vehiculo extends Model
{

    use HasFactory;
    protected $fillable = ['marca', 'modelo_id', 'placa_id', 'categoria_id', 'foto', 'precio_dia', 'activo'];

    protected $appends = [
        'photo_url',
    ];

    public function placa()
    {
        return $this->belongsTo(Placa::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class);
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'vehiculos')
    {
        tap($this->foto, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'foto' => $photo->storePublicly(
                    $storagePath, ['disk' => 'public']
                ),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deletePhoto()
    {
        if (is_null($this->foto)) return;

        Storage::disk('public')->delete($this->foto);

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
