<?php

namespace App\Livewire;

use App\Models\Vehiculo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class VehiculoIndex extends Component
{
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

        if ($v->foto) Storage::delete(str_replace("/storage/", "", $v->foto));

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
        $vehiculos = Vehiculo::matching($this->search, 'marca', 'id')
            ->with('categoria', 'modelo', 'placa')
            ->latest('id')
            ->get();

        return view('livewire.vehiculo-index', compact('vehiculos'));
    }
}
