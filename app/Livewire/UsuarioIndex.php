<?php

namespace App\Livewire;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UsuarioIndex extends Component
{
    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($userId)
    {
        $this->dispatch('editUsuario', $userId);
    }

    #[On('deleteUsuario')]
    public function deleteUsuario($id)
    {
        $user = User::findOrFail($id);

        (new DeleteUser())->delete($user);

        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('usuarioCreated')]
    #[On('usuarioUpdated')]
    public function render()
    {
        $usuarios = User::matching($this->search, 'name', 'email')
            ->with('roles')
            ->latest('id')
            ->get();

        return view('livewire.usuario-index', compact('usuarios'));
    }
}
