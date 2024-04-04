<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight flex flex-col sm:flex-row justify-between items-center">
            <span class="">Bonjour {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            <span>Tableau de bord</span>
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <x-ui.card title="Informations personnelles">
            <ul>
                <li>Nom : </li>
                <li>Prénom : </li>
                <li>Date de naissance : </li>
                <li>Numéro de téléphone : </li>
                <li>Adresse email : </li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="Modifier mes informations" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

        <x-ui.card title="Vos séances passées">
            <ul>
                <li>le : 18/05/2023</li>
                <li>le : 08/03/2023</li>
                <li>le : 02/12/2022</li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="Voir toutes les séances" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

        <x-ui.card title="Vos séances à venir">
            <ul>
                <li>le : 27/10/2023</li>
                <li>le : 30/12/2023</li>
            </ul>
            <x-slot:actions>
                <x-ui.link label="Voir toutes les séances" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

        <x-ui.card title="Vos prédictions">
            <ul>
                <li>Votre chemin de vie : 9</li>
                <li>Votre année personnelle</li>
                <li>Faire un tirage de Tarot</li>
            </ul>
        </x-ui.card>

        <x-ui.card title="Articles enregistrés">
            I am using slots here.
            <x-slot:actions>
                <x-ui.link label="Voir tous les articles" href="{{ route('home') }}" />
            </x-slot:actions>
        </x-ui.card>

    </div>

</x-app-layout>
