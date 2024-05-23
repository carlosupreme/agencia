<div class="flex flex-col gap-2">
    <div class="flex w-full items-center gap-3">
        <x-input
            wire:model.live="search"
            type="search"
            class="w-full"
            placeholder="Buscar modelo"
        />
        @livewire('modelo-create')
    </div>

    <div
        class="rounded-sm border border-stroke bg-white px-5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5"
    >
        <div class="max-w-full overflow-x-auto">
            @if(count($modelos) > 0)
                <table class="w-full table-auto">
                    <thead>
                    <tr class="bg-gray-2 text-left dark:bg-meta-4">
                        <th
                            class="min-w-[220px] px-4 py-4 font-medium text-black dark:text-white xl:pl-11"
                        >
                            Nombre
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Fecha de creacion
                        </th>
                        <th
                            class="min-w-[150px] px-4 py-4 font-medium text-black dark:text-white"
                        >
                            Vehiculos asociados
                        </th>
                        <th class="px-4 py-4 font-medium text-black dark:text-white">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modelos as $modelo)
                        <tr wire:key="{{ $modelo->id }}">
                            <td
                                class="border-b border-[#eee] px-4 py-5 pl-9 dark:border-strokedark xl:pl-11"
                            >
                                <h5 class="font-medium text-black dark:text-white">{{$modelo->nombre}}</h5>
                                <p class="text-xs text-graydark dark:text-gray ">ID:{{$modelo->id}}</p>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-black dark:text-white flex items-center gap-2">
                                    <x-far-clock class="h-3 w-3"/>
                                    <span class="first-letter:uppercase">
                                    {{$modelo->created_at->diffForHumans()}}
                                    </span>
                                </p>
                            </td>
                            <td class="text-center border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <p class="text-center text-black dark:text-white flex items-center gap-2">
                                    <x-fas-car class="h-3 w-3"/>
                                    <span class="first-letter:uppercase">
                                    {{$modelo->vehiculos_count}}
                                    </span>
                                </p>
                            </td>
                            <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                <div class="flex items-center space-x-3.5">
                                    <button class="hover:text-primary" wire:click="edit({{ $modelo->id }})">
                                        <x-far-pen-to-square class="fill-current h-5 w-5"/>
                                    </button>

                                    @php
                                        $sePuedeBorrar = $modelo->vehiculos->where('activo', true)->count() === 0;
                                    @endphp
                                    @if($sePuedeBorrar)
                                        <button class="hover:text-primary" wire:click="confirmDelete({{$modelo->id}})">
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
                    No hay modelos
                </h2>
            @endif
        </div>
    </div>

    @livewire('modelo-edit')

    @livewire('delete-modal', [
        'modalId' => 'deleteModeloModal',
        'action' => 'deleteModelo',
        'actionName' => 'Eliminar',
        'title' => 'Eliminar modelo',
        'content' => '¿Está seguro de que desea eliminar este modelo? <b>Esta acción es irreversible</b>',
        ])
</div>
