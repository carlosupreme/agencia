<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TarjetaIndex extends Component
{

    public $tarjetas;

    public function mount()
    {
        $this->tarjetas = Auth::user()->tarjetas;
    }
    public function render()
    {
        return view('livewire.tarjeta-index');
    }
}
