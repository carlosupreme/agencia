<div class="flex flex-col gap-2">
    <div class="flex w-full items-center gap-3">
        <x-input
            wire:model.live="search"
            type="search"
            class="w-full"
            placeholder="Buscar auto"
        />
        @livewire('vehiculo-create')
    </div>

    <div
        class="rounded-sm border border-stroke bg-white px-5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5"
    >
        <div class="max-w-full overflow-x-auto">
            @if(count($vehiculos) > 0)
                <table class="w-full table-auto">
                    <thead>
                    <tr class="bg-gray-2 text-left dark:bg-meta-4">
                        <th
                            class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Vehiculo
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Foto
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Categoria
                        </th>
                        <th class="px-4 py-4 font-medium text-black dark:text-white">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehiculos as $vehiculo)
                        <tr wire:key="{{ $vehiculo->id }}">
                            <td
                                class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark"
                            >
                                <h5 class="font-medium text-black dark:text-white">{{$vehiculo->marca}} {{$vehiculo->modelo}} {{$vehiculo->placas}}</h5>
                                <p class="text-xs text-graydark dark:text-gray ">ID:{{$vehiculo->id}}</p>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">

                                @if($vehiculo->foto)
                                    <img
                                        src="{{$vehiculo->foto }}"
                                        alt="Foto de {{$vehiculo->marca}} {{$vehiculo->modelo}}"
                                        class="w-16 h-16 object-contain rounded-md"
                                    >
                                @endif

                            </td>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-center text-black dark:text-white flex items-center gap-2">
                                    <x-fas-tag class="h-3 w-3"/>
                                    <span class="first-letter:uppercase">
                                    {{$vehiculo->categoria->nombre}}
                                    </span>
                                </p>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <div class="flex items-center space-x-3.5">

                                    <button class="hover:text-primary"
                                            wire:click="edit({{ $vehiculo->id }})"
                                    >
                                        <x-far-pen-to-square class="fill-current h-5 w-5"/>
                                    </button>
                                    <button class="hover:text-primary" wire:click="confirmDelete({{$vehiculo->id}})">
                                        <x-far-trash-can class="fill-current h-5 w-5"/>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2 class="py-4 text-center text-3xl dark:text-gray text-graydark">
                    No hay vehiculos
                </h2>
            @endif
        </div>
    </div>

    @livewire('vehiculo-edit')

    @livewire('delete-modal', [
        'modalId' => 'deleteVehiculoModal',
        'action' => 'deleteVehiculo',
        'actionName' => 'Eliminar',
        'title' => 'Eliminar vechiulo',
        'content' => '¿Está seguro de que desea eliminar esta vechiulo? <b>Esta acción es irreversible</b>',
        ])
</div>
