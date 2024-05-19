<x-dialog-modal wire:model="open">
    <x-slot name="title">
        <h2><strong>Crear vehiculo</strong></h2>
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="marca">Marca</label>
                <x-input class="w-full" wire:model="marca" type="text" name="marca" id="marca"/>
                <x-input-error for="marca"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="modelo">Modelo</label>
                <x-input class="w-full" wire:model="modelo" type="text" name="modelo" id="modelo"/>
                <x-input-error for="modelo"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="placas">Placas</label>
                <x-input class="w-full" wire:model="placas" type="text" name="placas" id="placas"/>
                <x-input-error for="placas"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="categoria">Categoria</label>
                <div class="flex flex-col gap-2">
                    <select
                        wire:model="categoria_id"
                        id="categoria"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                        :class="isOptionSelected && 'text-black dark:text-white'"
                        @change="isOptionSelected = true"
                    >
                        <option selected disabled value="" class="text-body">Selecciona una categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                        @endforeach
                    </select>

                    <x-input-error for="categoria_id"/>
                </div>
            </div>

            @if($foto)
                <div class="col-span-2 md:col-span-1">
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Foto actual</span>
                    <img src="{{$foto}}" alt="Foto" class="h-32 object-contain rounded-lg"/>
                </div>
            @endif

            <div class="col-span-2 md:col-span-1">
                <label for="1-file"
                       class="flex flex-col items-center justify-center h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-black hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span>
                            o arrastra el archivo</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG </p>
                    </div>
                    <input id="1-file" type="file" class="hidden" wire:model.live="newFoto"/>
                </label>
            </div>

            @if($newFoto)
                <div class="col-span-2 md:col-span-1">
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2">Nueva Foto</span>
                    <img src="{{$newFoto->temporaryUrl()}}" alt="Foto" class="h-32 object-contain rounded-lg"/>
                </div>
            @endif
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="resetValues" class="mr-2">Cancelar</x-secondary-button>
        <button wire:click="updateVehiculo" wire:loading.attr="disabled"
                class="px-4 py-2.5 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300">
            Editar
        </button>
    </x-slot>
</x-dialog-modal>
