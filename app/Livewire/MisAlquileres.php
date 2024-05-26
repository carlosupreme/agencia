<?php

namespace App\Livewire;

use App\Models\Alquiler;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisAlquileres extends Component
{

    public function modalVer($vehiculoId)
    {
        $this->dispatch('verVehiculo', $vehiculoId)->to(VehiculoShow::class);
    }

    public function render()
    {
        checkFechaFinVehiculos();
        $vehiculos = Alquiler::where('user_id', Auth::id())->with('vehiculo')->get();
        return view('livewire.mis-alquileres', compact('vehiculos'));
    }
}
