<x-app-layout>
    @section('css')
        @vite(['resources/css/add/numerology_tree.css'])
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Prédictions') }}
        </h2>
    </x-slot>


            <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

                @livewire('numerology-tree', ['user' => $user])

            </article>

            <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                @livewire('tarot-scope', ['user' => $user])

                {{-- <x-tarot.tarot-interpretation /> --}}
            </article>
            <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                Lune
            </article>
            <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                Saison
            </article>
            <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">
                Astrologie
            </article>

</x-app-layout>
