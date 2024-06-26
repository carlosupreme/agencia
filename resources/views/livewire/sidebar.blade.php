<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark xl:static xl:translate-x-0"
    @click.outside="sidebarToggle = false"
>
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 xl:py-6.5">
        <img src="{{ asset('logo.png') }}" alt="Logo"/>

        <button
            class="block xl:hidden"
            @click.stop="sidebarToggle = !sidebarToggle"
        >
            <svg
                class="fill-current"
                width="20"
                height="18"
                viewBox="0 0 20 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill=""
                />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div
        class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear"
    >
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 xl:mt-9 xl:px-6">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a
                            @class([
                                    'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                    'bg-graydark dark:bg-meta-4' => request()->routeIs('dashboard')
                                ])
                            href="{{ route('dashboard') }}"
                        >
                            <x-fas-home class="fill-current h-5 w-5"/>
                            Dashboard
                        </a>

                    </li>
                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Tarjetas -->
                    <li>
                        <a
                            @class([
                                        'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                        'bg-graydark dark:bg-meta-4' => request()->routeIs('tarjeta.index')
                                    ])
                            href="{{route('tarjeta.index')}}"
                        >
                            <x-far-credit-card class="fill-current h-5 w-5"/>
                            Mis tarjetas
                        </a>
                    </li>
                    <!-- Menu Item Tarjetas -->

                    <!-- Menu Item alquiler -->
                    <li>
                        <a
                            href="{{route('alquiler.index')}}"
                            @class([
                                    'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                    'bg-graydark dark:bg-meta-4' => request()->routeIs('alquiler.index')
                            ])
                        >
                            <x-fas-money-check-dollar class="fill-current h-5 w-5"/>
                            Alquilar
                        </a>
                    </li>
                    <!-- Menu Item alquiler -->

                    <!-- Menu Item autos -->
                    @role('admin')
                    <li>
                        <a
                            href="{{route('vehiculo.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('vehiculo.index')
                            ])
                        >
                            <x-fas-car class="fill-current h-5 w-5"/>
                            Autos
                        </a>

                    </li>
                    <!-- Menu Item autos -->

                    <!-- Menu Item categorias -->
                    <li>
                        <a
                            href="{{route('categoria.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('categoria.index')
                            ])
                        >
                            <x-fas-tags class="fill-current h-5 w-5"/>
                            Categorias
                        </a>
                    </li>
                    <!-- Menu Item categorias -->

                    <!-- Usuarios -->
                    <li>
                        <a
                            href="{{route('usuario.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('usuario.index')
                            ])
                        >
                            <x-fas-user-friends class="fill-current h-5 w-5"/>
                            Usuarios
                        </a>
                    </li>

                    <!-- Usuarios -->

                    <!-- Modelos -->
                    <li>
                        <a
                            href="{{route('modelo.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('modelo.index')
                            ])
                        >
                            <x-fas-atlas class="fill-current h-5 w-5"/>
                            Modelos
                        </a>
                    </li>

                    <!-- Modelos -->

                    <!-- Placas -->
                    <li>
                        <a
                            href="{{route('placa.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('placa.index')
                            ])
                        >
                            <x-fas-tarp class="fill-current h-5 w-5"/>
                            Placas
                        </a>
                    </li>
                    <!-- Placas -->

                    <!-- Marcas -->
                    <li>
                        <a
                            href="{{route('marca.index')}}"
                            @class([
                                'group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4',
                                'bg-graydark dark:bg-meta-4' => request()->routeIs('marca.index')
                            ])
                        >
                            <x-tabler-brand-toyota class="h-5 w-5"/>
                            Marcas
                        </a>
                    </li>
                    @endrole
                    <!-- Marcas -->
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
