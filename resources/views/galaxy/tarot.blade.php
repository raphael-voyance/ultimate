<x-app-layout>
    @section('js')
        @vite(['resources/js/add/tarot.js'])
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Tirage de tarot
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        <section class="mb-4">
            
            @livewire('tarot')

        </section>

    </article>

</x-app-layout>
