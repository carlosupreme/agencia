<?php

namespace App\Livewire;

use App\Models\Modelo;
use Livewire\Attributes\On;
use Livewire\Component;

class ModeloIndex extends Component
{
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($modeloId)
    {
        $this->dispatch('editModelo', $modeloId);
    }

    #[On('deleteModelo')]
    public function deleteModelo($id)
    {
        Modelo::destroy($id);
        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('modeloCreated')]
    #[On('modeloUpdated')]
    public function render()
    {
        $modelos = Modelo::matching($this->search, 'nombre', 'id')
            ->withCount('vehiculos')
            ->with('vehiculos')
            ->latest('id')
            ->get();

        return view('livewire.modelo-index', compact('modelos'));
    }
}
