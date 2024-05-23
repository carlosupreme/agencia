<?php

namespace App\Livewire;

use App\Models\Vehiculo;
use Carbon\Carbon;
use Livewire\Component;

class AlquilerIndex extends Component
{
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function modalAlquilar($vehiculoId)
    {
        $this->dispatch('alquilarVehiculo', $vehiculoId)->to(AlquilerCreate::class);
    }

    public function render()
    {
        $tieneTarjetas = auth()->user()->tarjetas->count() > 0;
        checkFechaFinVehiculos();

        $vehiculos = Vehiculo::matching($this->search, 'marca')
            // ->where('activo', false)
            ->with('categoria', 'modelo')
            ->latest('id')
            ->get();

        return view('livewire.alquiler-index', compact('vehiculos', 'tieneTarjetas'));
    }
}
