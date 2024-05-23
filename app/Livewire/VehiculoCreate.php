<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Modelo;
use App\Models\Placa;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class VehiculoCreate extends Component
{

    use WithFileUploads;

    #[Validate('required')]
    public $marca = '';

    #[Validate('required')]
    public $modelo_id = '';

    #[Validate('required')]
    public $placa_id = '';

    #[Validate('required|numeric')]
    public $precio_dia = '';

    #[Validate('required|exists:categorias,id')]
    public $categoria_id = '';

    #[Validate('image|nullable')]
    public $foto;

    public $categorias = [];
    public $placas = [];
    public $modelos = [];

    public $open = false;

    public function beVisible()
    {
        $this->categorias = Categoria::select('id', 'nombre')->get();
        $this->modelos = Modelo::select('id', 'nombre')->get();
        $this->placas = Placa::select('id', 'placa')->get()->filter(function ($placa) {
            return !Vehiculo::where('placa_id', $placa->id)->exists();
        });
        $this->open = true;
    }

    public function store()
    {
        $this->validate();

        $vehiculo = Vehiculo::create([
            'marca' => $this->marca,
            'modelo_id' => $this->modelo_id,
            'placa_id' => $this->placa_id,
            'precio_dia' => $this->precio_dia,
            'categoria_id' => $this->categoria_id
        ]);

        if ($this->foto) {
            $vehiculo->updatePhoto($this->foto);
        }

        $this->dispatch('vehiculoCreated');
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
        return view('livewire.vehiculo-create');
    }
}
