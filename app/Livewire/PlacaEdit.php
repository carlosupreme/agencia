<?php

namespace App\Livewire;

use App\Models\Placa;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class PlacaEdit extends Component
{
    public Placa $placa;

    public $open = false;

    public $nombre;

    #[On('editPlaca')]
    public function editPlaca($id): void
    {
        $this->placa = Placa::findOrfail($id);
        $this->nombre = $this->placa->placa;
        $this->open = true;
    }

    public function updatePlaca(): void
    {
        $this->validate([
            'nombre' => ['required', Rule::unique('placas', 'placa')->ignoreModel($this->placa)]
        ]);

        $this->placa->update([
            'placa' => $this->nombre
        ]);

        $this->dispatch('placaUpdated');
        $this->resetValues();
    }

    public function resetValues(): void
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.placa-edit');
    }
}
