<x-app-layout>

    @role('admin')
    <div
        class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5"
    >
        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
                <x-fas-tags class="fill-primary dark:fill-white h-6 w-6"/>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white"
                    >
                        {{ App\Models\Categoria::count() }}
                    </h4>
                    <span class="text-sm font-medium">Categorias</span>
                </div>

                <a
                    href="{{route('categoria.index')}}"
                    class="flex items-center gap-1 text-sm font-medium text-meta-5"
                >
                    Ver más
                    <x-fas-arrow-right class="fill-meta-5 h-3 w-3"/>
                </a>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
                <x-fas-car class="fill-primary dark:fill-white h-6 w-6"/>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white"
                    >
                        {{ \App\Models\Vehiculo::count() }}
                    </h4>
                    <span class="text-sm font-medium">Vehiculos</span>
                </div>

                <a
                    href="{{route('vehiculo.index')}}"
                    class="flex items-center gap-1 text-sm font-medium text-meta-5"
                >
                    Ver más
                    <x-fas-arrow-right class="fill-meta-5 h-3 w-3"/>
                </a>
            </div>
        </div>
        <!-- Card Item End -->

        <!-- Card Item Start -->
        <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <div
                class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
                <x-fas-user-friends class="fill-primary dark:fill-white h-6 w-6"/>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4
                        class="text-title-md font-bold text-black dark:text-white"
                    >
                        {{ \App\Models\User::count() }}
                    </h4>
                    <span class="text-sm font-medium">Usuarios</span>
                </div>

                <a
                    href="{{route('usuario.index')}}"
                    class="flex items-center gap-1 text-sm font-medium text-meta-5"
                >
                    Ver más
                    <x-fas-arrow-right class="fill-meta-5 h-3 w-3"/>
                </a>
            </div>
        </div>
        <!-- Card Item End -->
    </div>
    @endrole

    <h2 class="my-5 text-3xl text-black dark:text-white">Vehiculos alquilados</h2>
    @php
        $vehiculos = \App\Models\Alquiler::where('user_id', auth()->id())->with('vehiculo')
        ->get();
    @endphp

    <div class="max-w-full flex flex-wrap items-center gap-4 overflow-x-auto mt-5">
        @if(count($vehiculos) > 0)
            @foreach($vehiculos as $vehiculo)
                <div wire:key="{{$vehiculo->id}}"
                     class="min-w-96 max-w-96 bg-white rounded-lg dark:bg-black shadow-xl border-gray-500">
                    <img class="rounded-t-lg object-cover w-full" src="{{$vehiculo->vehiculo->foto}}"
                         alt="Foto de {{$vehiculo->vehiculo->modelo}}"/>
                    <div class="p-5">
                        <h5 class="flex items-center justify-between mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <span>{{$vehiculo->vehiculo->marca}} {{$vehiculo->vehiculo->modelo}}</span>
                            <span class="text-lg font-medium">Total: $ {{$vehiculo->monto}} </span>
                        </h5>
                        <div class="mb-3 flex flex-col gap-2 font-normal text-gray-700 dark:text-gray-400">
                            <p>Fecha de alquiler : {{ $vehiculo->fecha_inicio }}</p>
                            <p>Fecha de devolucion : {{ $vehiculo->fecha_fin }}</p>
                            <p>Dias
                                alquilado: {{ \Carbon\Carbon::parse($vehiculo->fecha_inicio)->diffInDays(\Carbon\Carbon::parse($vehiculo->fecha_fin)) }}</p>
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

</x-app-layout>
