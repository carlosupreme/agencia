<div class="min-w-fit">
    <x-button wire:click="beVisible"> Crear vehiculo</x-button>
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
                           for="modelo">Nombre</label>
                    <div class="flex flex-col gap-2">
                        <select
                            wire:model="modelo_id"
                            id="modelo"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                            :class="isOptionSelected && 'text-black dark:text-white'"
                            @change="isOptionSelected = true"
                        >
                            <option selected disabled value="" class="text-body">Selecciona un nombre</option>
                            @foreach($modelos as $modelo)
                                <option value="{{$modelo->id}}">{{$modelo->nombre}}</option>
                            @endforeach
                        </select>

                        <x-input-error for="modelo_id"/>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="placa">Placa</label>
                    <div class="flex flex-col gap-2">
                        <select
                            wire:model="placa_id"
                            id="placa"
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                            :class="isOptionSelected && 'text-black dark:text-white'"
                            @change="isOptionSelected = true"
                        >
                            <option selected disabled value="" class="text-body">Selecciona una placa</option>
                            @foreach($placas as $placa)
                                <option value="{{$placa->id}}">{{$placa->placa}}</option>
                            @endforeach
                        </select>

                        <x-input-error for="placa_id"/>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="precio_dia">Precio al dia</label>
                    <x-input class="w-full" wire:model="precio_dia" type="number" name="precio_dia" id="precio_dia"/>
                    <x-input-error for="precio_dia"/>
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

                <div class="col-span-2 md:col-span-1">
                    <label for="dropzone-file"
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
                        <input id="dropzone-file" type="file" class="hidden" wire:model.live="foto"/>
                    </label>
                </div>

                <div class="col-span-2 md:col-span-1">
                    @if($foto)
                        <img src="{{$foto->temporaryUrl()}}" alt="Foto" class="h-32 object-contain rounded-lg"/>
                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="resetValues" class="mr-2">Cancelar</x-secondary-button>
            <button wire:click="store"
                    class="px-4 py-2.5 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
