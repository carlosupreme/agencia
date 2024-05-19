<?php

namespace App\Livewire;

use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TarjetaCreate extends Component
{

    #[Validate('required|numeric|digits:16')]
    public $numero;

    #[Validate('required')]
    public $titular;

    #[Validate('required')]
    public $banco;

    #[Validate('required|in:debito,credito')]
    public $tipo = "debito";

    #[Validate('required|date')]
    public $vencimiento;

    #[Validate('required|numeric|digits:3')]
    public $cvv;


    public function addCard()
    {
        $this->validate();

        Tarjeta::create([
            'user_id' => Auth::user()->id,
            'numero' => $this->numero,
            'titular' => $this->titular,
            'banco' => $this->banco,
            'tipo' => $this->tipo,
            'vencimiento' => $this->vencimiento,
            'cvv' => $this->cvv,
        ]);

        $this->dispatch('tarjetaCreated');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.tarjeta-create');
    }
}
