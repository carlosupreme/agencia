<?php

namespace App\Livewire;

use App\Models\Vehiculo;
use Livewire\Attributes\On;
use Livewire\Component;

class VehiculoShow extends Component
{
    public $open = false;

    public Vehiculo $vehiculo;

    public $marca;

    public $modelo;
    public $placa;
    public $categoria;
    public $precio_dia;
    public $foto;
    public $activo;

    #[On('verVehiculo')]
    public function verVehiculo($vehiculoId)
    {
        $this->vehiculo = Vehiculo::findOrFail($vehiculoId);
        $this->marca = $this->vehiculo->marca?->nombre;
        $this->modelo = $this->vehiculo->modelo?->nombre;
        $this->placa = $this->vehiculo->placa?->placa;
        $this->categoria = $this->vehiculo->categoria?->nombre;
        $this->precio_dia = $this->vehiculo->precio_dia;
        $this->foto = $this->vehiculo->photo_url;
        $this->activo = $this->vehiculo->activo;
        $this->open = true;
    }

    public function resetValues(): void
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.vehiculo-show');
    }
}
