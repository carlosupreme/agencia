<?php

namespace App\Livewire;

use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class AlquilerIndex extends Component
{
    use WithPagination;
    public $perPage = 4;
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function modalAlquilar($vehiculoId)
    {
        $this->dispatch('alquilarVehiculo', $vehiculoId)->to(AlquilerCreate::class);
    }

    public function modalVer($vehiculoId)
    {
        $this->dispatch('verVehiculo', $vehiculoId)->to(VehiculoShow::class);
    }

    public function cargarMas()
    {
        $this->perPage += 4;
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
            ->paginate($this->perPage);

        return view('livewire.alquiler-index', compact('vehiculos', 'tieneTarjetas'));
    }
}
