<x-dialog-modal wire:model="open">
    <x-slot name="title">
        <h2><strong>Detalles del vehiculo</strong></h2>
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="marca">Marca</label>
                <x-input readonly class="w-full" wire:model="marca" type="text" name="marca" id="marca"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="marca">Placas</label>
                <x-input readonly class="w-full" wire:model="placa" type="text" name="marca" id="marca"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="marca">Nombre</label>
                <x-input readonly class="w-full" wire:model="modelo" type="text" name="marca" id="marca"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="precio_dia">Precio al dia</label>
                <x-input readonly class="w-full" wire:model="precio_dia" type="number" name="precio_dia" id="precio_dia"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="categoria">Categoria</label>
                <x-input readonly class="w-full" wire:model="categoria" type="text" name="precio_dia" id="precio_dia"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="categoria">Foto</label>
                <img src="{{$foto}}" alt="Foto">
            </div>

        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="resetValues" class="mr-2">Salir</x-secondary-button>
    </x-slot>
</x-dialog-modal>
