<?php

namespace App\Livewire;

use App\Models\Vehiculo;
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

        $vehiculos = Vehiculo::matching($this->search, 'placas', 'modelo', 'marca')
            ->where('activo', false)
            ->with('categoria')
            ->latest('id')
            ->get();

        return view('livewire.alquiler-index', compact('vehiculos', 'tieneTarjetas'));
    }
}
