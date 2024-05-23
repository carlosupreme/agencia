<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 rounded-xl justify-center items-center">
    @foreach($tarjetas as $tarjeta)
        <div
            class="w-full bg-gray-100 dark:bg-graydark rounded-xl shadow-2xl transition-transform transform relative">
            <img class="object-cover w-full h-24 rounded-t-xl" src="{{asset('card-cover.png')}}" alt="Card Image">
            <div class="px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium tracking-widest text-gray-800 dark:text-gray-200">{{$tarjeta->titular}}</p>
                        <p class="mt-2 font-medium tracking-more-wider text-gray-800 dark:text-gray-200"> {{ substr_replace($tarjeta->numero, '**** **** **** ', 0, 12) }}</p>
                    </div>
                    <img class="w-14 h-14" src="https://i.imgur.com/bbPHJVe.png" alt="Bank Logo">
                </div>

                <p class="font-medium tracking-widest text-sm text-gray-800 dark:text-gray-200 first-letter:uppercase">{{$tarjeta->tipo}}</p>

                <div class="flex justify-between mt-4">
                    <div>
                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">Vencimiento</p>
                        <p class="font-medium tracking-wider text-sm text-gray-800 dark:text-gray-200">{{$tarjeta->vencimiento}}</p>
                    </div>
                    <div>
                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">Banco</p>
                        <p class="font-medium tracking-wider text-sm text-gray-800 dark:text-gray-200">{{$tarjeta->banco}}</p>
                    </div>
                    <div>
                        <p class="font-light text-xs text-gray-600 dark:text-gray-400">CVV</p>
                        <p class="font-bold tracking-more-wider text-sm text-gray-800 dark:text-gray-200">···</p>
                    </div>
                </div>
            </div>
            <x-far-trash-can wire:click="delete({{$tarjeta->id}})" class="text-white dark:text-black h-5 w-5 absolute top-4 right-4 cursor-pointer"/>
        </div>
    @endforeach
</div>
