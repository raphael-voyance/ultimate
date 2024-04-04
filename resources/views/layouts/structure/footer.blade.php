@props(['fullWidth' => false])

<footer
    {{
        $attributes->class([
            "mx-auto w-full",
            "max-w-screen-2xl" => !$fullWidth
        ])
    }}
>
<div class="p-6">
    Footer Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus eos dolorum nemo minus minima adipisci reprehenderit labore quam voluptatum in ratione perspiciatis ipsa accusantium blanditiis dolore, necessitatibus quia aliquam praesentium!
</div>
</footer>
