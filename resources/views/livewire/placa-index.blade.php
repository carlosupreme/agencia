<div class="flex flex-col gap-2">
    <div class="flex w-full items-center gap-3">
        <x-input
            wire:model.live="search"
            type="search"
            class="w-full"
            placeholder="Buscar modelo"
        />
        @livewire('placa-create')
    </div>

    <div
        class="rounded-sm border border-stroke bg-white px-5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5"
    >
        <div class="max-w-full overflow-x-auto">
            @if(count($placas) > 0)
                <table class="w-full table-auto">
                    <thead>
                    <tr class="bg-gray-2 text-left dark:bg-meta-4">
                        <th
                            class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11"
                        >
                            Placa
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Fecha de creacion
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Está en uso
                        </th>
                        <th class="px-4 py-4 font-medium text-black dark:text-white">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($placas as $placa)
                        <tr wire:key="{{ $placa->id }}">
                            <td
                                class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11"
                            >
                                <h5 class="font-medium text-black dark:text-white">{{$placa->placa}}</h5>
                                <p class="text-xs text-graydark dark:text-gray ">ID:{{$placa->id}}</p>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-black dark:text-white flex items-center gap-2">
                                    <x-far-clock class="h-3 w-3"/>
                                    <span class="first-letter:uppercase">
                                    {{$placa->created_at->diffForHumans()}}
                                    </span>
                                </p>
                            </td>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <div class="text-center text-black dark:text-white flex items-center gap-2">
                                    @if($placa?->vehiculo)
                                        <div class="rounded-full w-3 h-3 bg-green-500"></div>
                                        <span>Si</span>
                                    @else
                                        <div class="rounded-full w-3 h-3 bg-rose-500"></div>
                                        <span>No</span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <div class="flex items-center space-x-3.5">
                                    <button class="hover:text-primary" wire:click="edit({{ $placa->id }})">
                                        <x-far-pen-to-square class="fill-current h-5 w-5"/>
                                    </button>
                                    @if(!$placa?->vehiculo?->activo)
                                        <button class="hover:text-primary" wire:click="confirmDelete({{$placa->id}})">
                                            <x-far-trash-can class="fill-current h-5 w-5"/>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2 class="py-4 text-center text-3xl dark:text-gray text-graydark">
                    No hay placas
                </h2>
            @endif
        </div>
    </div>

    @livewire('placa-edit')

    @livewire('delete-modal', [
        'modalId' => 'deletePlacaModal',
        'action' => 'deletePlaca',
        'actionName' => 'Eliminar',
        'title' => 'Eliminar placa',
        'content' => '¿Está seguro de que desea eliminar esta placa? <b>Esta acción es irreversible</b>',
        ])
</div>
