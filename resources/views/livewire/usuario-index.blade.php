<div class="flex flex-col gap-2">
    <div class="flex w-full items-center gap-3">
        <x-input
            wire:model.live="search"
            type="search"
            class="w-full"
            placeholder="Buscar usuario"
        />
        @livewire('usuario-create')
    </div>

    <div
        class="rounded-sm border border-stroke bg-white px-5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5"
    >
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    <th
                        class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white"
                    >
                        Nombre
                    </th>
                    <th
                        class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                    >
                        Correo
                    </th>
                    <th
                        class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                    >
                        Es admin
                    </th>
                    <th class="px-4 py-4 font-medium text-black dark:text-white">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr wire:key="{{ $usuario->id }}">
                        <td
                            class=" flex gap-2 items-center border-b border-[#eee] px-4 py-5 dark:border-strokedark"
                        >
                            <img
                                src="{{$usuario->profile_photo_url }}"
                                alt="Foto de{{$usuario->name}}"
                                class="w-10 h-10 object-contain rounded-full"
                            >
                            <div>
                                <h5 class="font-medium text-black dark:text-white">{{$usuario->name}}</h5>
                                <p class="text-xs text-graydark dark:text-gray ">ID:{{$usuario->id}}</p>

                            </div>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <h5 class="font-medium text-black dark:text-white">{{$usuario->email}}</h5>
                        </td>
                        <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            <div class="text-center text-black dark:text-white flex items-center gap-2">
                                @if($usuario->hasRole('admin'))
                                    <div class="rounded-full w-3 h-3 bg-green-500"></div>
                                    <span>Si</span>
                                @else
                                    <div class="rounded-full w-3 h-3 bg-rose-500"></div>
                                    <span>No</span>
                                @endif
                            </div>
                        </td>
                        <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                            @if(Auth::user()->id == $usuario->id)
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Tú</span>
                            @else
                                <div class="flex items-center gap-3">
                                    <button class="hover:text-primary"
                                            wire:click="edit({{ $usuario->id }})"
                                    >
                                        <x-far-pen-to-square class="fill-current h-5 w-5"/>
                                    </button>
                                    <button class="hover:text-primary" wire:click="confirmDelete({{$usuario->id}})">
                                        <x-far-trash-can class="fill-current h-5 w-5"/>
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @livewire('usuario-edit')

    @livewire('delete-modal', [
        'modalId' => 'deleteUsuarioModal',
        'action' => 'deleteUsuario',
        'actionName' => 'Eliminar',
        'title' => 'Eliminar usuario',
        'content' => '¿Está seguro de que desea eliminar este usuario? <b>Esta acción es irreversible</b>',
        ])
</div>
