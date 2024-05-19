<?php

namespace App\Livewire;

use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TarjetaIndex extends Component
{
    public function delete($id)
    {
        Tarjeta::find($id)->delete();
        $this->dispatch('tarjetaDeleted')->self();
    }

    #[On('tarjetaDeleted')]
    #[On('tarjetaCreated')]
    public function render()
    {
        $tarjetas = Auth::user()->tarjetas;
        return view('livewire.tarjeta-index', compact('tarjetas'));
    }
}
