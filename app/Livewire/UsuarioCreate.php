<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsuarioCreate extends Component
{

    #[Validate('required')]
    public $name = '';

    #[Validate('required|email|unique:users,email')]
    public $email = '';

    #[Validate('required|min:8')]
    public $password = '';

    public $open = false;

    public $rolesOptions = [];

    #[Validate('array')]
    public $roles = [];

    public function beVisible()
    {
        $this->rolesOptions = Role::all('id', 'name')->toArray();
        $this->open = true;
    }

    public function store()
    {
        $this->validate();

        $u = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $u->roles()->sync($this->roles);

        $this->dispatch('usuarioCreated');
        $this->resetValues();
    }

    public function resetValues(): void
    {
        $this->resetExcept('rolesOptions');
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.usuario-create');
    }
}
