<?php

namespace App\Livewire;

use App\Models\Marca;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MarcaCreate extends Component
{
    #[Validate('required|unique:marcas,nombre')]
    public $nombre;

    public $open = false;

    public function store()
    {
        $this->validate();

        Marca::create([
            'nombre' => $this->nombre
        ]);

        $this->dispatch('marcaCreated');
        $this->reset();
    }

    public function resetValues():void
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.marca-create');
    }
}
