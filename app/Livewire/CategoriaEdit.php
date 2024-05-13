<?php

namespace App\Livewire;

use App\Models\Categoria;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoriaEdit extends Component
{
    public Categoria $categoria;

    public $open = false;

    public $nombre;


    #[On('editCategoria')]
    public function editCategoria($id): void
    {
        $this->categoria = Categoria::findOrfail($id);
        $this->nombre = $this->categoria->nombre;
        $this->open = true;
    }

    public function updateCategoria(): void
    {
        $this->validate([
            'nombre' => ['required', Rule::unique('categorias', 'nombre')->ignoreModel($this->categoria)]
        ]);

        $this->categoria->update([
            'nombre' => $this->nombre
        ]);

        $this->dispatch('categoriaUpdated');
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
        return view('livewire.categoria-edit');
    }
}
