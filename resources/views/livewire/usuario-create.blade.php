<div class="min-w-fit">
    <x-button wire:click="beVisible">Crear usuario</x-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2><strong>Crear usuario</strong></h2>
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2 gap-4">

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="name">Nombre</label>
                    <x-input class="w-full" wire:model="name" type="text" name="name" id="name"/>
                    <x-input-error for="name"/>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="email">Email</label>
                    <x-input class="w-full" wire:model="email" type="text" name="email" id="email"/>
                    <x-input-error for="email"/>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="password">Contraseña</label>
                    <x-input class="w-full" wire:model="password" type="text" name="password" id="password"/>
                    <x-input-error for="password"/>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2"
                           for="role">Roles</label>
                    <div class="flex flex-wrap gap-8 w-full mt-1">
                        @foreach($rolesOptions as $role)
                            <label class="block text-sm font-medium text-gray-700" for="{{$role['id']}}">
                                <input class="focus:ring-blue-500 text-blue-600 border-gray-300 rounded w-5 h-5"
                                       id="{{$role['id']}}" type="checkbox" wire:model="roles" value="{{$role['id']}}">
                                <span class="ml-2 cursor-pointer dark:text-gray-400">{{__($role['name'])}}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error for="roles"/>
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
