<?php

use App\Models\Vehiculo;
use Carbon\Carbon;

// pone inactivos los vehiculos que ya pasaron su fecha de fin
function checkFechaFinVehiculos()
{
    $vehiculos = Vehiculo::where('activo', true)->get();

    $vehiculos->each(function ($vehiculo) {
        $a = $vehiculo->alquileres->filter(function ($alquiler) {
            $s = Carbon::now()->diffInDays(Carbon::parse($alquiler->fecha_fin));
            return $s < 0;
        });

        $a->each(function ($alquiler) {
            $alquiler->update(['activo' => false]);
            $alquiler->vehiculo->update(['activo' => false]);
        });
    });
}
