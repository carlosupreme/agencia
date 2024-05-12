<button {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex justify-center rounded-lg bg-primary p-3 font-medium text-gray hover:bg-opacity-90"]) }}>
    {{ $slot }}
</button>
