<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/draws.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <div class="text-center sm:pl-4 mt-2 sm:mt-0 sm:text-left">
                <span> Tous les tirages : </span>
            </div>
        </h2>
    </x-slot>

    <section>
        <header class="mb-6 flex flex-wrap flex-row gap-3 justify-normal items-center">
            <a href="{{ route('admin.draw.create') }}" class="btn btn-sm">Créer un tirage</a>
            <a href="{{ route('admin.tarot.index') }}" class="btn btn-sm">Accéder aux interprétations des cartes</a>
        </header>

        <section>
            @livewire('admin.data-table-draw')
        </section>

    </section>

</x-admin-layout>
