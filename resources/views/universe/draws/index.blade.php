<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <a href="{{ route('admin.index') }}" class="btn btn-ghost btn-circle"><i class="fa-light fa-arrow-left"></i></a>
            <span>Tous les tirages</span>
        </h2>
    </x-slot>

    <section>
        <header>
            <a class="btn">Créer un tirage</a>
        </header>

        <section>
            tableau des tirages
            @dump($draws)
        </section>

    </section>

</x-admin-layout>
