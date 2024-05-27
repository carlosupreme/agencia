<?php

namespace App\Livewire;

use App\Models\Marca;
use Livewire\Attributes\On;
use Livewire\Component;

class MarcaIndex extends Component
{
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($marcaId)
    {
        $this->dispatch('editMarca', $marcaId);
    }

    #[On('deleteMarca')]
    public function deleteMarca($id)
    {
        Marca::destroy($id);
        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('marcaCreated')]
    #[On('marcaUpdated')]
    public function render()
    {
        $marcas = Marca::matching($this->search, 'nombre', 'id')
            ->withCount('vehiculos')
            ->with('vehiculos')
            ->latest('id')
            ->get();

        return view('livewire.marca-index', compact('marcas'));
    }
}
