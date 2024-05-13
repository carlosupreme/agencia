<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoriasIndex extends Component
{

    public $search;
    public $queryString = ['search' => ['except' => '', 'as' => 's']];

    #[On('deleteCategoria')]
    public function deleteCategoria($id)
    {
        Categoria::destroy($id);
        $this->dispatch('actionCompleted');

        return redirect()->route('categoria.index')->with('flash.banner', 'Usuario eliminado');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    public function render()
    {
        $categorias = Categoria::
        where('nombre', 'LIKE', "%{$this->search}%")
            ->withCount('vehiculos')
            ->latest('id')
            ->get();

        return view('livewire.categorias-index', [
            'categorias' => $categorias
        ]);
    }
}
