<?php

namespace App\Livewire;

use App\Models\Categoria;
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
    public $modelo = '';

    #[Validate('required')]
    public $placas = '';

    #[Validate('required|exists:categorias,id')]
    public $categoria_id = '';

    #[Validate('image|nullable')]
    public $foto;

    public $categorias;

    public $open = false;

    public function mount()
    {
        $this->categorias = Categoria::select('id', 'nombre')->get();
    }

    public function store()
    {
        $this->validate();

        Vehiculo::create([
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'placas' => $this->placas,
            'categoria_id' => $this->categoria_id,
            'foto' => $this->foto ? Storage::url($this->foto->store('vehiculos')) : null,
        ]);

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
