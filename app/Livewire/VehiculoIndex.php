<?php

namespace App\Livewire;

use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class VehiculoIndex extends Component
{
    use WithPagination;

    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($vehiculoId)
    {
        $this->dispatch('editVehiculo', $vehiculoId);
    }

    #[On('deleteVehiculo')]
    public function deleteVehiculo($id)
    {
        $v = Vehiculo::findOrFail($id);
        $v->deletePhoto();
        $v->delete();

        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('vehiculoCreated')]
    #[On('vehiculoUpdated')]
    public function render()
    {
        $vehiculos = Vehiculo::matching($this->search, 'id')
            ->orwhereHas('marca', function ($query) {
                $query->where('nombre', 'like', "%$this->search%");
            })
            ->orwhereHas('categoria', function ($query) {
                $query->where('nombre', 'like', "%$this->search%");
            })
            ->orwhereHas('modelo', function ($query) {
                $query->where('nombre', 'like', "%$this->search%");
            })
            ->orwhereHas('placa', function ($query) {
                $query->where('placa', 'like', "%$this->search%");
            })
            ->with('categoria', 'modelo', 'placa', 'marca')
            ->latest('id')
            ->paginate(10);

        return view('livewire.vehiculo-index', compact('vehiculos'));
    }
}
