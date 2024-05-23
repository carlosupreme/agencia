<?php

namespace App\Livewire;

use App\Models\Modelo;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModeloCreate extends Component
{
    #[Validate('required|unique:modelos,nombre')]
    public $nombre;

    public $open = false;

    public function store()
    {
        $this->validate();

        Modelo::create([
            'nombre' => $this->nombre
        ]);

        $this->dispatch('modeloCreated');
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
        return view('livewire.modelo-create');
    }
}
