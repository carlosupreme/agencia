<?php

namespace App\Livewire;

use App\Models\Alquiler;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AlquilerCreate extends Component
{

    public $open = false;

    public Vehiculo $vehiculo;

    #[Validate('required|date')]
    public $fecha_inicio;

    #[Validate('required|date|after:fecha_inicio')]
    public $fecha_fin;

    public $total;

    #[Validate('numeric')]
    public $tarjeta_id;

    public $tarjetas = [];

    #[On('alquilarVehiculo')]
    public function alquilarVehiculo($vehiculoId)
    {
        $this->vehiculo = Vehiculo::findOrfail($vehiculoId);
        $this->fecha_inicio = Carbon::today()->format('Y-m-d');
        $this->fecha_fin = Carbon::tomorrow()->format('Y-m-d');
        $this->tarjetas = Auth::user()->tarjetas;
        $this->tarjeta_id = $this->tarjetas->first()->id;
        $this->open = true;
    }

    public function seleccionarTarjeta($tarjetaId)
    {
        $this->tarjeta_id = $tarjetaId;
    }
    public function confirmar()
    {
        $this->validate();

        $dias = Carbon::parse($this->fecha_inicio)->diffInDays(Carbon::parse($this->fecha_fin));

        Alquiler::create([
            'vehiculo_id' => $this->vehiculo->id,
            'tarjeta_id' => $this->tarjeta_id,
            'user_id' => Auth::user()->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'monto' => $this->vehiculo->precio_dia * $dias
        ]);

        $this->dispatch('alquilerCreated');
        $this->resetValues();

        return redirect()->to(route('dashboard'))->with('flash.banner', 'Alquiler realizado con éxito.');
    }

    public function resetValues(): void
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.alquiler-create');
    }
}
