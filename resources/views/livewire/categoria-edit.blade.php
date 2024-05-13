<x-dialog-modal wire:model="open" max-width="sm">
    <x-slot name="title">
        <h2><strong>Editar Categoria</strong></h2>
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col gap-2 justify-center">
            <label>
                <x-input class="w-full" placeholder="Nombre" wire:model="nombre" type="text" name="nombre"
                         id="nombre"/>
            </label>
            <x-input-error for="nombre"/>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="resetValues" class="mr-2">Cancelar</x-secondary-button>
        <button wire:click="updateCategoria"
                class="px-4 py-2.5 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300">
            Editar
        </button>
    </x-slot>
</x-dialog-modal>
