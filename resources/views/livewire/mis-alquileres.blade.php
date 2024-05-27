<div class="max-w-full mx-auto p-4 flex flex-wrap">
    @livewire('vehiculo-show')
    @if(count($vehiculos) > 0)
        @foreach($vehiculos as $vehiculo)
            <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                <div class="bg-white dark:bg-black rounded-lg shadow-md overflow-hidden flex flex-col">
                    <div class="relative w-full h-48">
                        <img class="absolute inset-0 w-full h-full object-cover"
                             src="{{$vehiculo->vehiculo->photo_url}}"
                             alt="Foto de {{$vehiculo->vehiculo->modelo->nombre}}"/>
                    </div>
                    <div class="p-4 flex flex-col gap-4 justify-between flex-grow">
                        <div class="flex flex-col gap-4">
                            <h3 class="text-2xl font-semibold flex justify-between">
                                <span>{{$vehiculo->vehiculo->modelo->nombre}}</span>
                                @if($vehiculo->activo)
                                    <span
                                        class="text-sm max-w-fit bg-green-100 text-green-800 font-medium px-2.5 py-2 rounded-lg dark:bg-green-900 dark:text-green-300">Activo</span>
                                @else
                                    <span
                                        class="text-sm max-w-fit bg-red-100 text-red-800 font-medium px-2.5 py-2 rounded-lg dark:bg-red-900 dark:text-red-300">Vencido</span>
                                @endif
                            </h3>
                            <span class="text-lg font-medium">Total: $ {{$vehiculo->monto}} </span>
                        </div>
                        <div class="mb-3 flex flex-col gap-2 font-normal text-gray-700 dark:text-gray-400">
                            <p>Fecha de alquiler
                                : {{ \Carbon\Carbon::parse($vehiculo->fecha_inicio)->format('d/m/Y') }}</p>
                            <p>Fecha de devolucion
                                : {{ \Carbon\Carbon::parse($vehiculo->fecha_fin)->format('d/m/Y')}}</p>
                            <p>Dias
                                alquilado: {{ \Carbon\Carbon::parse($vehiculo->fecha_inicio)->diffInDays(\Carbon\Carbon::parse($vehiculo->fecha_fin)) }}</p>
                        </div>

                        <x-button class="w-full bg-blue-600" wire:click="modalVer({{$vehiculo->id}})">
                            Ver más
                        </x-button>
                    </div>
                </div>
            </div>
        @endforeach

    @else
        <h2 class="py-4 text-center text-3xl dark:text-gray text-graydark">
            No hay vehiculos rentados
        </h2>
    @endif
</div>
