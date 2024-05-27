<?php

namespace App\Livewire;

use App\Models\Marca;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class MarcaEdit extends Component
{
    public Marca $marca;

    public $open = false;

    public $nombre;

    #[On('editMarca')]
    public function editMarca($id): void
    {
        $this->marca = Marca::findOrfail($id);
        $this->nombre = $this->marca->nombre;
        $this->open = true;
    }

    public function updateMarca(): void
    {
        $this->validate([
            'nombre' => ['required', Rule::unique('marcas', 'nombre')->ignoreModel($this->marca)]
        ]);

        $this->marca->update([
            'nombre' => $this->nombre
        ]);

        $this->dispatch('marcaUpdated');
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
        return view('livewire.marca-edit');
    }
}
