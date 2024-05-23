<?php

namespace App\Livewire;

use App\Models\Modelo;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class ModeloEdit extends Component
{
    public Modelo $modelo;

    public $open = false;

    public $nombre;

    #[On('editModelo')]
    public function editModelo($id): void
    {
        $this->modelo = Modelo::findOrfail($id);
        $this->nombre = $this->modelo->nombre;
        $this->open = true;
    }

    public function updateModelo(): void
    {
        $this->validate([
            'nombre' => ['required', Rule::unique('modelos', 'nombre')->ignoreModel($this->modelo)]
        ]);

        $this->modelo->update([
            'nombre' => $this->nombre
        ]);

        $this->dispatch('modeloUpdated');
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
        return view('livewire.modelo-edit');
    }
}
