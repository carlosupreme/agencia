<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsuarioEdit extends Component
{
    public User $user;

    public $open = false;

    public $name = '';

    public $email = '';

    public $rolesOptions = [];

    public $roles = [];

    #[On('editUsuario')]
    public function editUsuario($userId)
    {
        $this->rolesOptions = Role::all('name', 'id')->toArray();
        $this->user = User::findOrfail($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->user->roles->each(fn($role) => $this->roles[] = $role->id);
        $this->open = true;
    }

    public function updateUser(): void
    {
        $this->validate([
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignoreModel($this->user)
            ]
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        if(count($this->roles) > 0)
            $this->user->roles()->sync($this->roles);

        $this->dispatch('usuarioUpdated');
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
        return view('livewire.usuario-edit');
    }
}
