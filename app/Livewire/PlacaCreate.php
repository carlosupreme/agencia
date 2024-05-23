<?php

namespace App\Livewire;

use App\Models\Placa;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PlacaCreate extends Component
{
    #[Validate('required|unique:placas,placa')]
    public $placa;

    public $open = false;

    public function store()
    {
        $this->validate();

        Placa::create([
            'placa' => $this->placa
        ]);

        $this->dispatch('placaCreated');
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
        return view('livewire.placa-create');
    }
}
