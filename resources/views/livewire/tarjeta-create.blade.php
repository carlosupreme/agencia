<div class="flex flex-col items-center justify-between p-4 mb-4">
    <div class="bg-white dark:bg-black w-full max-w-3xl mx-auto px-6 py-8 shadow-md rounded-md flex">
        <div class="w-full sm:w-1/2 sm:pr-8 sm:border-r-2 sm:border-slate-300">
            <label class="text-neutral-800 dark:text-white font-bold text-sm mb-2 block">Numero de tarjeta (16):</label>
            <x-input
                type="tel"
                inputmode="numeric"
                pattern="[0-9\s]{16}"
                autocomplete="cc-number"
                maxlength="16"
                wire:model="numero"
                class="mb-1 h-10"
                placeholder="0000 0000 0000 0000"
            />
            <x-input-error for="numero" class="mb-4"/>

            <div class="flex gap-2 mt-2 flex-wrap">
                <div class="flex-1">
                    <label class="text-neutral-800 dark:text-white font-bold text-sm mb-2 block">Fecha de
                        vencimiento:</label>
                    <x-input
                        wire:model="vencimiento"
                        type="date"
                        class="mb-1 h-10"
                    />
                    <x-input-error for="vencimiento" class="mb-4"/>
                </div>
                <div class="flex-1">
                    <label class="text-neutral-800 dark:text-white font-bold text-sm mb-2 block">CVV:</label>
                    <x-input
                        wire:model="cvv"
                        type="tel"
                        inputmode="numeric"
                        maxlength="3"
                        class="mb-1 h-10"
                        placeholder="000"
                    />
                    <x-input-error for="cvv" class="mb-4"/>
                </div>
            </div>

            <div class="flex flex-wrap gap-x-2 mt-2 sm:flex-nowrap">
                <div>
                    <label class="text-neutral-800 dark:text-white font-bold text-sm mb-2 block">Banco:
                    </label>
                    <x-input
                        wire:model="banco"
                        type="text"
                        class="mb-1 h-10"
                        placeholder="Entidad bancaria"
                    />
                    <x-input-error for="banco" class="mb-4"/>
                </div>

                <div>
                    <label for="tipo" class="text-neutral-800 dark:text-white font-bold text-sm mb-2 block">Tipo de
                        tarjeta:
                    </label>
                    <select
                        wire:model="tipo"
                        id="tipo"
                        class="relative z-20 h-10 w-full appearance-none rounded-lg border border-stroke bg-transparent pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                    >
                        <option selected disabled value="" class="text-body">Selecciona una categoria</option>
                        <option value="credito">Credito</option>
                        <option value="debito">Debito</option>
                    </select>
                </div>
            </div>

            <label class="text-neutral-800 dark:text-white font-bold text-sm my-2 block">Titular:</label>
            <x-input
                wire:model="titular"
                type="text"
                class="mb-1 h-10"
                placeholder="Nombre del titular"
                value="{{Auth::user()->name}}"
            />
            <x-input-error for="titular" class="mb-4"/>

            <x-button type="button" wire:click="addCard" class="mt-2 block w-full sm:hidden">Agregar</x-button>

        </div>
        <div class="hidden sm:block sm:w-1/2 pl-8">
            <div class="w-full h-56" style="perspective: 1000px">
                <div class="crediCard relative cursor-pointer transition-transform duration-500"
                     style="transform-style: preserve-3d">
                    <div class="w-full m-auto rounded-xl shadow-2xl absolute">
                        <img src="{{ asset('Card-1.jpg') }}" class="object-cover w-full h-full"/>
                    </div>
                </div>
            </div>
            <x-button type="button" wire:click="addCard" class="w-full">Agregar</x-button>
        </div>
    </div>
</div>
