<x-dialog-modal wire:model="open">
    <x-slot name="title">
        <h2><strong>Alquilar vehiculo</strong></h2>
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="fecha_inicio">Fecha inicio</label>
                <x-input class="w-full" wire:model="fecha_inicio" type="date" name="fecha_inicio" id="fecha_inicio"/>
                <x-input-error for="fecha_inicio"/>
            </div>

            <div class="col-span-2 md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                       for="fecha_fin">Fecha devolucion</label>
                <x-input class="w-full" wire:model="fecha_fin" type="date" name="fecha_fin" id="fecha_fin"/>
                <x-input-error for="fecha_fin"/>
            </div>

            <div class="col-span-2">
                <h4 class="mb-2">Elige una tarjeta</h4>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 gap-6 rounded-xl justify-center items-center">
                    @foreach($tarjetas as $tarjeta)
                        <div
                                wire:key="{{$tarjeta->id}}"
                                wire:click="seleccionarTarjeta({{$tarjeta->id}})"
                                @class([
                                    "w-full bg-red-100 dark:bg-gray-800 rounded-xl shadow-2xl transition-transform transform hover:scale-110",
                                    "scale-110" => $tarjeta_id== $tarjeta->id,])>
                            <img class="object-cover w-full h-12 rounded-t-xl" src="https://i.imgur.com/kGkSg1v.png"
                                 alt="Card Image">
                            <div class="px-8 py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium tracking-wide text-gray-800 dark:text-gray-200">{{$tarjeta->titular}}</p>
                                        <p class="mt-2 font-medium tracking-wider text-gray-800 dark:text-gray-200"> {{ substr_replace($tarjeta->numero, '**** **** **** ', 0, 12) }}</p>
                                    </div>
                                    <img class="w-8 h-8" src="https://i.imgur.com/bbPHJVe.png" alt="Bank Logo">
                                </div>

                                <p class="font-medium tracking-widest text-sm text-gray-800 dark:text-gray-200 first-letter:uppercase">{{$tarjeta->tipo}}</p>

                                <div class="flex justify-between mt-4">
                                    <div>
                                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">Vencimiento</p>
                                        <p class="font-medium tracking-wider text-sm text-gray-800 dark:text-gray-200">{{$tarjeta->vencimiento}}</p>
                                    </div>
                                    <div>
                                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">Banco</p>
                                        <p class="font-medium tracking-wider text-sm text-gray-800 dark:text-gray-200">{{$tarjeta->banco}}</p>
                                    </div>
                                    <div>
                                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">CVV</p>
                                        <p class="font-bold tracking-more-wider text-sm text-gray-800 dark:text-gray-200">
                                            ···</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="resetValues" class="mr-2">Cancelar</x-secondary-button>
        <button wire:click="confirmar" wire:loading.attr="disabled"
                class="px-4 py-2.5 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
            Alquilar
        </button>
    </x-slot>
</x-dialog-modal>
