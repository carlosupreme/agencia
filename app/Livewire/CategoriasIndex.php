<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoriasIndex extends Component
{

    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    public function edit($categoriaId)
    {
        $this->dispatch('editCategoria', $categoriaId);
    }

    #[On('deleteCategoria')]
    public function deleteCategoria($id)
    {
        Categoria::destroy($id);
        $this->dispatch('actionCompleted');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('actionCompleted')]
    #[On('categoriaCreated')]
    #[On('categoriaUpdated')]
    public function render()
    {
        $categorias = Categoria::where('nombre', 'LIKE', "%{$this->search}%")
            ->withCount('vehiculos')
            ->latest('id')
            ->get();

        return view('livewire.categorias-index', [
            'categorias' => $categorias
        ]);
    }
}
