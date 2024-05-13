<x-app-layout>

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
                    href="#"
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
                    href="#"
                    class="flex items-center gap-1 text-sm font-medium text-meta-5"
                >
                    Ver más
                    <x-fas-arrow-right class="fill-meta-5 h-3 w-3"/>
                </a>
            </div>
        </div>
        <!-- Card Item End -->
    </div>

</x-app-layout>
