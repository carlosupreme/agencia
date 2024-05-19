<x-app-layout>
    <div
        class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
    >
        <h2 class="text-title-md2 font-bold text-black dark:text-white">
            Alquilar un vehiculo
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Alquilar</li>
            </ol>
        </nav>
    </div>
    @livewire('alquiler-index')
</x-app-layout>
