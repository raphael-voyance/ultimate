<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Rendez-vous
        </h2>
    </x-slot>

    <article class="p-4 sm:p-8 bg-neutral sm:rounded-lg">

        @livewire('data-table-appointment')
        
    </article>

</x-app-layout>
