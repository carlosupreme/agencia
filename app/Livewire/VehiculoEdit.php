<?php

namespace App\Livewire;

use App\Models\Categoria;
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

    #[Validate('required')]
    public $marca = '';

    #[Validate('required')]
    public $modelo = '';

    #[Validate('required')]
    public $placas = '';

    #[Validate('required|exists:categorias,id')]
    public $categoria_id = '';
    public $foto;

    #[Validate('image|nullable')]
    public $newFoto;

    #[On('editVehiculo')]
    public function editVehiculo($vehiculoId)
    {
        $this->categorias = Categoria::select('id', 'nombre')->get();
        $this->vehiculo = Vehiculo::findOrfail($vehiculoId);
        $this->marca = $this->vehiculo->marca;
        $this->modelo = $this->vehiculo->modelo;
        $this->placas = $this->vehiculo->placas;
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
            'modelo' => $this->modelo,
            'placas' => $this->placas,
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
