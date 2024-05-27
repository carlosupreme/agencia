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
    @livewire('vehiculo-show')

    <div class="max-w-full mx-auto p-4 flex flex-wrap justify-center">
        @if(count($vehiculos) > 0)
            @foreach($vehiculos as $vehiculo)
                <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                    <div class="bg-white dark:bg-black rounded-lg shadow-md overflow-hidden flex flex-col">
                        <div class="relative w-full h-48">
                            <img class="absolute inset-0 w-full h-full object-cover" src="{{$vehiculo->photo_url}}"
                                 alt="Foto de {{$vehiculo->modelo->nombre}}"/>
                        </div>
                        <div class="p-4 flex flex-col gap-4 justify-between flex-grow">
                            <div class="flex flex-col gap-4">
                                <h3 class="text-2xl font-semibold">{{$vehiculo->modelo->nombre}}</h3>
                                <p class="text-xl text-gray-700">$ {{$vehiculo->precio_dia}} por dia</p>
                            </div>


                            <div class="flex items-center gap-2">
                                <x-button class="w-full bg-blue-600" wire:click="modalVer({{$vehiculo->id}})">
                                    Ver más
                                </x-button>

                                @if($vehiculo->activo)
                                    <span
                                        class="text-center bg-red-100 text-red-800 font-medium p-3 rounded-lg dark:bg-red-900 dark:text-red-300">Alquilado</span>
                                @elseif(!$tieneTarjetas)
                                    <div class="flex flex-col gap-2">
                                <span
                                    class="w-fit bg-yellow-100 text-yellow-800 font-medium px-3 rounded-lg dark:bg-yellow-900 dark:text-yellow-300">
                                    No tienes tarjetas registradas.
                                </span>
                                        <a href="{{route('tarjeta.index')}}" class="text-sm underline">Registra una
                                            aquí</a>
                                    </div>
                                @else
                                    <x-button class="w-full text-center items-center flex gap-2"
                                              wire:click="modalAlquilar({{$vehiculo->id}})">
                                        Alquilar
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </x-button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            <h2 class="py-4 text-center text-3xl dark:text-gray text-graydark">
                No hay vehiculos para rentar
            </h2>
        @endif
    </div>
    <div x-intersect="$wire.cargarMas()">
        <h1 class="text-7xl text-center">...</h1>
    </div>
</div>
