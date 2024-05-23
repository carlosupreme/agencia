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
        checkFechaFinVehiculos();

        $vehiculos = Vehiculo::matching($this->search, 'marca')
            ->orwhereHas('categoria', function ($query) {
                $query->where('nombre', 'like', "%$this->search%");
            })
            ->orwhereHas('modelo', function ($query) {
                $query->where('nombre', 'like', "%$this->search%");
            })
            ->orwhereHas('placa', function ($query) {
                $query->where('placa', 'like', "%$this->search%");
            })
            // ->where('activo', false)
            ->with('categoria', 'modelo')
            ->latest('id')
            ->get();

        return view('livewire.alquiler-index', compact('vehiculos', 'tieneTarjetas'));
    }
}
