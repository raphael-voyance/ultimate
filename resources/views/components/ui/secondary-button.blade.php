<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-secondary text-white/70']) }}>
    {{ $slot }}
</button>
