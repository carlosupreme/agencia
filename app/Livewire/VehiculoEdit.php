<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Placa;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class VehiculoEdit extends Component
{
    use WithFileUploads;

    public Vehiculo $vehiculo;
    public $open = false;
    public $categorias = [];
    public $placas = [];
    public $modelos = [];
    public $marcas = [];

    #[Validate('required')]
    public $marca_id = '';

    #[Validate('required')]
    public $modelo_id = '';

    #[Validate('required')]
    public $placa_id;

    #[Validate('required|numeric')]
    public $precio_dia = '';

    #[Validate('required')]
    public $categoria_id = '';
    public $foto;

    #[Validate('image|nullable')]
    public $newFoto;

    public function mount()
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
        $this->placas = Placa::all();
    }

    #[On('editVehiculo')]
    public function editVehiculo($vehiculoId)
    {
        $this->vehiculo = Vehiculo::findOrfail($vehiculoId);
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
        $this->placa_id = $this->vehiculo->placa_id;
        $this->placas = Placa::all()->filter(function ($placa) {
            return !Vehiculo::where('placa_id', $placa->id)->exists() || $placa->id == $this->placa_id;
        });
        $this->marca_id = $this->vehiculo->marca_id;
        $this->modelo_id = $this->vehiculo->modelo_id;
        $this->precio_dia = $this->vehiculo->precio_dia;
        $this->categoria_id = $this->vehiculo->categoria_id;
        $this->foto = $this->vehiculo->foto;
        $this->open = true;
    }

    public function updateVehiculo(): void
    {
        $this->validate();

        $this->vehiculo->update([
            'marca_id' => $this->marca_id,
            'modelo_id' => $this->modelo_id,
            'placa_id' => $this->placa_id,
            'precio_dia' => $this->precio_dia,
            'categoria_id' => $this->categoria_id
        ]);

        if ($this->newFoto) {
            $this->vehiculo->updatePhoto($this->newFoto);
        }

        $this->dispatch('vehiculoUpdated');
        $this->resetValues();
    }

    public function resetValues(): void
    {
        $this->resetExcept('categorias');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.vehiculo-edit');
    }
}
