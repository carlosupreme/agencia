<?php

namespace App\Livewire;

use App\Models\Placa;
use Livewire\Attributes\On;
use Livewire\Component;

class PlacaIndex extends Component
{
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($placaId)
    {
        $this->dispatch('editPlaca', $placaId);
    }

    #[On('deletePlaca')]
    public function deletePlaca($id)
    {
        Placa::destroy($id);
        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('placaCreated')]
    #[On('placaUpdated')]
    public function render()
    {
        $placas = Placa::matching($this->search, 'placa', 'id')
            ->with('vehiculo')
            ->latest('id')
            ->get();

        debug($placas->toArray());
        return view('livewire.placa-index', compact('placas'));
    }
}
