<div class="flex flex-col gap-2">
    <div class="flex w-full items-center gap-3">
        <x-input
            wire:model.live="search"
            type="search"
            class="w-full"
            placeholder="Buscar auto"
        />
    </div>
    @livewire('alquiler-create')

    <div class="max-w-full overflow-x-auto mt-5">
        @if(count($vehiculos) > 0)
            @foreach($vehiculos as $vehiculo)
                <div wire:key="{{$vehiculo->id}}"
                     class="max-w-sm bg-white rounded-lg dark:bg-black shadow-xl border-gray-500">
                    <img class="rounded-t-lg object-cover w-full" src="{{$vehiculo->foto}}"
                         alt="Foto de {{$vehiculo->modelo}}"/>
                    <div class="p-5">
                        <h5 class="flex items-center justify-between mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <span>{{$vehiculo->marca}} {{$vehiculo->modelo}}</span>
                            <span class="text-lg font-medium">$ {{$vehiculo->precio_dia}} / Dia </span>
                        </h5>
                        <div class="mb-3 flex flex-col gap-2 font-normal text-gray-700 dark:text-gray-400">
                            <p>Placas : {{ $vehiculo->placas }}</p>
                            <p>Categoria : {{ $vehiculo->categoria->nombre }}</p>
                        </div>
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            wire:click="modalAlquilar({{$vehiculo->id}})"
                        >
                            Alquilar
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="py-4 text-center text-3xl dark:text-gray text-graydark">
                No hay vehiculos para rentar
            </h2>
        @endif
    </div>
</div>
