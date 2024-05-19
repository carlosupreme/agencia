<?php

namespace App\Livewire;

use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TarjetaIndex extends Component
{

    public $tarjetas;

    public function mount()
    {
        $this->tarjetas = Auth::user()->tarjetas;
    }

    public function delete($id)
    {
        Tarjeta::find($id)->delete();
        $this->dispatch('tarjetaDeleted')->self();
    }

    #[On('tarjetaDeleted')]
    #[On('tarjetaCreated')]
    public function render()
    {
        return view('livewire.tarjeta-index');
    }
}
