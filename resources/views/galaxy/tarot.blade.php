<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Tirage de tarot
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        <section class="mb-4">
            
            <x-tarot.drawing-card/>

        </section>

    </article>

</x-app-layout>
