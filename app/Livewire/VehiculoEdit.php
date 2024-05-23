<?php

namespace App\Livewire;

use App\Models\Categoria;
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

    #[Validate('required')]
    public $marca = '';

    #[Validate('required')]
    public $modelo_id = '';

    #[Validate('required')]
    public $placa_id;

    #[Validate('required|numeric')]
    public $precio_dia = '';

    #[Validate('required|exists:categorias,id')]
    public $categoria_id = '';
    public $foto;

    #[Validate('image|nullable')]
    public $newFoto;

    #[On('editVehiculo')]
    public function editVehiculo($vehiculoId)
    {
        $this->categorias = Categoria::select('id', 'nombre')->get();
        $this->modelos = Modelo::select('id', 'nombre')->get();
        $this->placas = Placa::select('id', 'placa')->get();
        $this->vehiculo = Vehiculo::findOrfail($vehiculoId);
        $this->marca = $this->vehiculo->marca;
        $this->modelo_id = $this->vehiculo->modelo_id;
        $this->placa_id = $this->vehiculo->placa_id;
        $this->precio_dia = $this->vehiculo->precio_dia;
        $this->categoria_id = $this->vehiculo->categoria_id;
        $this->foto = $this->vehiculo->foto;
        $this->open = true;
    }

    public function updateVehiculo(): void
    {
        $this->validate();

        if ($this->newFoto && $this->vehiculo->foto) {
            Storage::delete(str_replace("/storage/", "", $this->vehiculo->foto));
        }

        $this->vehiculo->update([
            'marca' => $this->marca,
            'modelo_id' => $this->modelo_id,
            'placa_id' => $this->placa_id,
            'precio_dia' => $this->precio_dia,
            'categoria_id' => $this->categoria_id,
            'foto' => $this->newFoto ? Storage::url($this->newFoto->store('vehiculos')) : $this->vehiculo->foto,
        ]);

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
