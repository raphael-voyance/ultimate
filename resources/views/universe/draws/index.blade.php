<x-admin-layout>
    @section("js")
        @vite("resources/js/add/universe/draws.js")
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Tous les tirages</span>
        </h2>
    </x-slot>

    <section>
        <header>
            <a href="{{ route('admin.draw.create') }}" class="btn">Créer un tirage</a>
            <a href="{{ route('admin.tarot.index') }}" class="btn">Accéder aux interprétations des cartes</a>
        </header>

        <section>
            @livewire('admin.data-table-draw')
        </section>

    </section>

</x-admin-layout>
